<?php

namespace app\task\model\shop;

use app\common\model\store\shop\Order as ShopOrderModel;
use app\common\service\Order as OrderService;

/**
 * 门店订单模型
 * Class Apply
 * @package app\task\model\dealer
 */
class Order extends ShopOrderModel
{
    /**
     * 获取未结算的核销订单
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUnSettledList()
    {
        $list = $this->where('is_invalid', '=', 0)
            ->where('is_settled', '=', 0)
            ->select();
        if ($list->isEmpty()) {
            return $list;
        }
        // 整理订单信息
        $with = ['goods' => ['refund']];
        return OrderService::getOrderList($list, 'order_master', $with);
    }

    /**
     * 标记订单已失效(批量)
     * @param $ids
     * @return false|int
     */
    public function setInvalid($ids)
    {
        return $this->isUpdate(true)
            ->save(['is_invalid' => 1], ['id' => ['in', $ids]]);
    }

}