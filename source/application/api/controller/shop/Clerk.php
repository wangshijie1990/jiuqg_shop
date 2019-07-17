<?php

namespace app\api\controller\shop;

use app\api\controller\Controller;
use app\api\model\store\shop\Clerk as ClerkModel;
use app\api\model\store\Shop as ShopModel;
use app\api\model\Order as OrderModel;
use app\api\model\store\shop\Order as ShopOrderModel;
use app\api\model\sharing\Order as SharingOrderModel;
use app\api\model\store\shop\Capital as CapitalModel;
use app\api\model\store\shop\Setting;
use app\api\model\store\shop\Withdraw as WithdrawModel;
use app\api\model\store\shop\Apply as ShopApplyModel;
use Think\log;
/**
 * 门店中心
 * Class Index
 * @package app\api\controller\user
 */
class Clerk extends Controller
{
    /* @var \app\api\model\User $user */
    private $user;
    private $setting;
    private $clerk;
    private $shop;
    /**
     * 构造方法
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function _initialize()
    {
        
        parent::_initialize();
        // 用户信息
        $this->user = $this->getUser();
        
        $this->setting = Setting::getAll();
        
        $this->clerk=ClerkModel::detail(['user_id' => $this->user['user_id']]);
        if($this->clerk){
            $this->shop=ShopModel::detail($this->clerk['shop_id']);
        }
    }

    /**
     * 门店中心
     * @return array
     */
    public function center()
    {
        
        if(!$this->clerk){
            $clerk=false;
        }
        else{
            $freez=0;
            $clerk=$this->clerk;
            $shop=ShopModel::detail($clerk['shop_id']);
            $model = new OrderModel;
            $orderCount=array();
            $orderCount['today']=$model->where('create_time','>',strtotime(date('Ymd')))->where('extract_shop_id',$clerk['shop_id'])->count();
            $orderCount['yesterday']=$model->where('create_time','<',strtotime(date('Ymd')))->where('create_time','>',strtotime(date('Ymd'))-24*3600)->where('extract_shop_id',$clerk['shop_id'])->count();
            $orderCount['total']=$model->where('extract_shop_id',$clerk['shop_id'])->count();
            
            $model=new ShopOrderModel;
            $shopOrderCount=array();
            $shopOrderCount['today']=$model->where('create_time','>',strtotime(date('Ymd')))->where('shop_id',$clerk['shop_id'])->count();
            $shopOrderCount['yesterday']=$model->where('create_time','<',strtotime(date('Ymd')))->where('create_time','>',strtotime(date('Ymd'))-24*3600)->where('shop_id',$clerk['shop_id'])->count();
            $shopOrderCount['total']=$model->where('shop_id',$clerk['shop_id'])->count();

            $freez=$model->freezMoney($clerk['shop_id']);
            //拼团订单
            $model=new SharingOrderModel;
            $sharingOrderCount=array();
            $sharingOrderCount['transfer']=$model->with(['active'])->join('sharing_active active', 'order.active_id = active.active_id', 'LEFT')->alias('order')->where('IF ( (`order`.`order_type` = 20), (`active`.`status` = 20), TRUE)')->where('order.pay_status',20)->where('order.order_status',10)->where('order.transfer_status',10)->where('order.extract_shop_id',$clerk['shop_id'])->count();
            $sharingOrderCount['receive']=$sharingOrderCount['transfer']=$model->with(['active'])->join('sharing_active active', 'order.active_id = active.active_id', 'LEFT')->alias('order')->where('IF ( (`order`.`order_type` = 20), (`active`.`status` = 20), TRUE)')->where('order.pay_status',20)->where('order.order_status',10)->where('order.transfer_status',20)->where('order.extract_shop_id',$clerk['shop_id'])->count();
            $sharingOrderCount['total']=$sharingOrderCount['transfer']=$model->with(['active'])->alias('order')->join('sharing_active active', 'order.active_id = active.active_id', 'LEFT')->where('IF ( (`order`.`order_type` = 20), (`active`.`status` = 20), TRUE)')->where('order.pay_status',20)->where('order.extract_shop_id',$clerk['shop_id'])->count();

            
            $model=new CapitalModel;
            $money=array();
            $money['today']=$model->where('shop_id',$clerk['shop_id'])->where('create_time','>',strtotime(date('Ymd')))->sum('money');
            $money['yesterday']=$model->where('shop_id',$clerk['shop_id'])->where('create_time','<',strtotime(date('Ymd')))->where('create_time','>',strtotime(date('Ymd'))-24*3600)->sum('money');
            $money['total']=$model->where('shop_id',$clerk['shop_id'])->sum('money');
            //冻结金额
            $shop['freez_money']=number_format($freez,2);

        }
        
        if($clerk){
            return $this->renderSuccess([
                // 当前是否为核销员
                'is_clerk' => $clerk,
                // 当前用户信息
                'user' => $this->user,
                'shop'=>($shop?$shop:false),
                'orderCount'=>($orderCount?$orderCount:false),
                'shopOrderCount'=>($shopOrderCount?$shopOrderCount:false),
                'sharingOrderCount'=>($sharingOrderCount?$sharingOrderCount:false),
                'money'=>($money?$money:0),
                'background' => $this->setting['background']['values']['index'],
                // 页面文字
                'words' => $this->setting['words']['values'],
            ]);
        }
        else{
            return $this->renderSuccess([
                // 当前是否为核销员
                'is_clerk' => $clerk,
                // 当前用户信息
                'user' => $this->user,
                'shop'=>false,
                'background' => $this->setting['background']['values']['index'],
                // 页面文字
                'words' => $this->setting['words']['values'],
            ]); 
        }
    }
    /**
     * 门店申请状态
     * @param null $referee_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function apply($referee_id = null)
    {
        // 推荐门店昵称
        $referee_name = '平台';
        if ($referee_id > 0 && ($referee = ClerkModel::get(array('user_id'=>$referee_id)))) {
            $referee_shop=ShopModel::detail($referee['shop_id']);
            if($referee_shop){
                $referee_name = $referee_shop['shop_name'];
            }
        }
        return $this->renderSuccess([
            // 当前是否为门店
            'is_shop' => $this->clerk,
            // 当前是否在申请中
            'is_applying' =>ShopApplyModel::isApplying($this->user['user_id']),
            // 推荐人昵称
            'referee_name' => $referee_name,
            // 背景图
            'background' => $this->setting['background']['values']['apply'],
            // 页面文字
            'words' => $this->setting['words']['values'],
            // 申请协议
            'license' => $this->setting['license']['values']['license'],
        ]);
    }
    /**
     * 门店提现信息
     * @return array
     */
    public function withdraw()
    {
        
        return $this->renderSuccess([
            // 门店用户信息
            'shop' => ShopModel::detail($this->clerk['shop_id']),
            // 结算设置
            'settlement' => $this->setting['settlement']['values'],
            // 背景图
            'background' => $this->setting['background']['values']['withdraw_apply'],
            // 页面文字
            'words' => $this->setting['words']['values'],
        ]);
    }
    /**
     * 提交提现申请
     * @param $data
     * @return array
     * @throws \app\common\exception\BaseException
     */
    public function submit($data)
    {
        if($this->clerk['draw']==20){
            return $this->renderError('您没有提现权限');
        }
        $formData = json_decode(htmlspecialchars_decode($data), true);
        $model = new WithdrawModel;
        if ($model->submit($this->shop,$this->user, $formData)) {
            return $this->renderSuccess([], '申请提现成功');
        }
        return $this->renderError($model->getError() ?: '提交失败');
    }
}