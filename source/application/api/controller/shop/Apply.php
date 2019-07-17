<?php

namespace app\api\controller\shop;

use app\api\controller\Controller;
use app\api\model\store\shop\Clerk as ClerkModel;
use app\api\model\store\Shop as ShopModel;
use app\api\model\store\shop\Setting;
use app\api\model\store\shop\Apply as ShopApplyModel;
use Think\log;
/**
 * 门店中心
 * Class Index
 * @package app\api\controller\user
 */
class Apply extends Controller
{
    /* @var \app\api\model\User $user */
    private $user;
    private $setting;
    private $clerk;
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
        
        $this->clerk=ClerkModel::get(['user_id' => $this->user['user_id'],'is_delete'=>0]);
        
    }

    /**
     * 门店申请状态
     * @param null $referee_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function index($referee_id = null)
    {
        // 推荐门店昵称
        $referee_name = '平台';
        if ($referee_id > 0 && ($referee = ClerkModel::get(array('user_id'=>$referee_id,'is_delete'=>0)))) {
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
            'user'=>$this->user
        ]);
    }
    
    /**
     * 提交门店申请
     * @param string $name
     * @param string $mobile
     * @return array
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function submit()
    {
        $model = new ShopApplyModel;
        if ($model->submit($this->user, $this->request->post())) {
            return $this->renderSuccess();
        }
        return $this->renderError($model->getError() ?: '提交失败');
    }
}