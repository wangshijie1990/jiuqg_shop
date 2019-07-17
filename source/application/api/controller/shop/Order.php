<?php

namespace app\api\controller\shop;

use app\api\controller\Controller;
use app\common\service\Order as OrderService;
use app\common\enum\OrderType as OrderTypeEnum;
use app\api\model\store\shop\Clerk as ClerkModel;
use app\api\model\Order as OrderModel;
use app\common\enum\order\PayType as PayTypeEnum;

/**
 * 自提订单管理
 * Class Order
 * @package app\api\controller\shop
 */
class Order extends Controller
{
    /* @var \app\api\model\User $user */
    private $user;

    /**
     * 构造方法
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->user = $this->getUser();   // 用户信息
    }

    /**
     * 核销订单详情
     * @param $order_id
     * @param int $order_type
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function detail($order_id, $order_type = OrderTypeEnum::MASTER)
    {
        // 订单详情
        $order = OrderService::getOrderDetail($order_id, $order_type);
        // 验证是否为该门店的核销员
        $clerkModel = ClerkModel::detail(['user_id' => $this->user['user_id']]);
        return $this->renderSuccess(compact('order', 'clerkModel'));
    }
    /**
     * 门店订单列表
     * @param $dataType
     * @return array
     * @throws \think\exception\DbException
     */
    public function lists($dataType)
    {
        $clerkModel = ClerkModel::detail(['user_id' => $this->user['user_id']]);
        $model = new OrderModel;
        $list = $model->getShopOrderList($clerkModel['shop_id'],$dataType);
        return $this->renderSuccess(compact('list'));
    }
    public function extractLists($user_id)
    {
            
        $clerkModel = ClerkModel::detail(['user_id' => $this->user['user_id']]);
        if(!$clerkModel){
            return $this->renderError('你没有核销权限');
        }
        $model = new OrderModel;
        $list = $model->getShopExtractOrderList($clerkModel['shop_id'], $user_id);
        return $this->renderSuccess(compact('list'));
    }
    /**
     * 确认核销
     * @param $order_id
     * @param int $order_type
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function extract($order_id, $order_type = OrderTypeEnum::MASTER)
    {
        // 订单详情
        $order = OrderService::getOrderDetail($order_id, $order_type);
        // 验证是否为该门店的核销员
        $clerkModel = ClerkModel::detail(['user_id' => $this->user['user_id']]);
        if(!$clerkModel){
            return $this->renderError('你没有核销权限');
        }
        if (!$clerkModel->checkUser($order['extract_shop_id'])) {
            return $this->renderError($clerkModel->getError());
        }
        // 确认核销
        if ($order->verificationOrder($clerkModel['clerk_id'])) {
            return $this->renderSuccess([], '订单核销成功');
        }
        return $this->renderError($order->getError() ?: '核销失败');
    }
    public function batchExtract($order_ids)
    {
        $order_ids=explode(',',$order_ids);
        foreach($order_ids as $k=>$order_id){
            // 订单详情
            $order = OrderService::getOrderDetail($order_id, OrderTypeEnum::MASTER);
            // 验证是否为该门店的核销员
            $clerkModel = ClerkModel::detail(['user_id' => $this->user['user_id']]);
            if(!$clerkModel){
                return $this->renderError('你没有核销权限');
            }
            if (!$clerkModel->checkUser($order['extract_shop_id'])) {
                return $this->renderError($clerkModel->getError());
            }
            // 确认核销
            if (!$order->verificationOrder($clerkModel['clerk_id'])) {
                return $this->renderError($order->getError() ?: '核销失败');
            }
        }
        return $this->renderSuccess([], '订单核销成功');
    }
}