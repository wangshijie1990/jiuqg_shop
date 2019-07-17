<?php

namespace app\api\service\order;

use think\Hook;
use app\api\service\Basics;
use app\api\model\User as UserModel;
use app\api\model\Order as OrderModel;
use app\api\model\Goods as GoodsModel;
use app\api\model\dealer\Apply as DealerApplyModel;
use app\api\model\user\BalanceLog as BalanceLogModel;
use app\api\model\WxappPrepayId as WxappPrepayIdModel;

use app\common\enum\user\balanceLog\Scene as SceneEnum;
use app\common\enum\order\PayType as PayTypeEnum;
use app\common\enum\OrderType as OrderTypeEnum;

/**
 * 订单支付成功服务类
 * Class PaySuccess
 * @package app\api\service\order
 */
class PaySuccess extends Basics
{
    // 订单模型
    public $model;

    // 当前用户信息
    private $user;

    //代付用户信息
    private $agentUser;
    /**
     * 构造函数
     * PaySuccess constructor.
     * @param $orderNo
     * @throws \think\exception\DbException
     */
    public function __construct($orderNo,$user_id=0)
    {
        // 实例化订单模型
        $this->model = OrderModel::getPayDetail($orderNo);
        if (!empty($this->model)) {
            $this->wxappId = $this->model['wxapp_id'];
        }
        // 获取用户信息
        $this->user = UserModel::detail($this->model['user_id']);
        if($user_id>0){
            $this->agentUser=UserModel::detail($user_id);
        }
    }

    /**
     * 获取订单详情
     * @return OrderModel|null
     */
    public function getOrderInfo()
    {
        return $this->model;
    }

    /**
     * 订单支付成功业务处理
     * @param $payType
     * @param array $payData
     * @return bool
     */
    public function onPaySuccess($payType, $payData = [])
    {
        if (empty($this->model)) {
            $this->error = '未找到该订单信息';
            return false;
        }
        // 更新付款状态
        $status = $this->updatePayStatus($payType, $payData);
        // 订单支付成功行为
        if ($status == true) {
            Hook::listen('order_pay_success', $this->model, OrderTypeEnum::MASTER);
        }
        return $status;
    }

    /**
     * 更新付款状态
     * @param $payType
     * @param array $payData
     * @return bool
     */
    private function updatePayStatus($payType, $payData = [])
    {
        // 验证余额支付时用户余额是否满足
        if ($payType == PayTypeEnum::BALANCE) {
            if($this->agentUser){
                if ($this->agentUser['balance'] < $this->model['pay_price']) {
                    $this->error = '用户余额不足，无法使用余额支付';
                    return false;
                }
            }
            else{
                if ($this->user['balance'] < $this->model['pay_price']) {
                    $this->error = '用户余额不足，无法使用余额支付';
                    return false;
                }
            }
        }
        $this->model->transaction(function () use ($payType, $payData) {
            // 更新商品库存、销量
            (new GoodsModel)->updateStockSales($this->model['goods']);
            // 整理订单信息
            $order = ['pay_type' => $payType, 'pay_status' => 20, 'pay_time' => time()];
            if ($payType == PayTypeEnum::WECHAT) {
                $order['transaction_id'] = $payData['transaction_id'];
            }
            // 更新订单状态
            $this->model->save($order);
            // 累积用户总消费金额
            $this->user->setIncPayMoney($this->model['pay_price']);
            // 购买指定商品成为分销商
            $this->becomeDealerUser($this->model['goods']);
            // 余额支付
            if ($payType == PayTypeEnum::BALANCE) {
                // 更新用户余额
                if($this->agentUser){
                    $this->agentUser->setDec('balance', $this->model['pay_price']);
                    BalanceLogModel::add((SceneEnum::AGENTPAY), [
                        'user_id' => $this->agentUser['user_id'],
                        'money' => -$this->model['pay_price'],
                    ], ['order_no' => $this->model['order_no']]);
                }
                else{
                    $this->user->setDec('balance', $this->model['pay_price']);
                    BalanceLogModel::add((SceneEnum::CONSUME), [
                        'user_id' => $this->user['user_id'],
                        'money' => -$this->model['pay_price'],
                    ], ['order_no' => $this->model['order_no']]);
                }
            }
            // 微信支付
            if ($payType == PayTypeEnum::WECHAT) {
                // 更新prepay_id记录
                WxappPrepayIdModel::updatePayStatus($this->model['order_id'], OrderTypeEnum::MASTER);
            }
        });
        return true;
    }

    /**
     * 购买指定商品成为分销商
     * @param $goodsList
     * @return bool
     * @throws \think\exception\DbException
     */
    private function becomeDealerUser($goodsList)
    {
        // 整理商品id集
        $goodsIds = [];
        foreach ($goodsList as $item) {
            $goodsIds[] = $item['goods_id'];
        }
        $model = new DealerApplyModel;
        if($this->agentUser){
            return $model->becomeDealerUser($this->agentUser['user_id'], $goodsIds, $this->wxappId);
        }
        return $model->becomeDealerUser($this->user['user_id'], $goodsIds, $this->wxappId);
    }

}