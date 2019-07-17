<?php

namespace app\api\model\store\shop;

use app\common\model\store\shop\Order as ShopOrderModel;

use app\common\model\Order as OrderModel;
use app\common\model\sharing\Order as ShareOrderModel;
/**
 * 商家门店核销订单记录模型
 * Class Order
 * @package app\api\model\store\shop
 */
class Order extends ShopOrderModel
{
    public function freezMoney($shop_id){
        $freez=0;
    	$model=new OrderModel;
        $list=  $model->where('extract_shop_id',$shop_id)->where('order_status',10)->where('pay_status',20)->select();
        if($list){
        	foreach($list as $order){
        		$capital=$this->getCapitalByOrder($order);
        		$freez+=$capital['first_shop_money'];
        	}
        }
        $model=new ShareOrderModel;
        $list=  $model->where('extract_shop_id',$shop_id)->where('order_status',10)->where('pay_status',20)->select();        
        if($list){
            foreach($list as $order){
                $capital=$this->getCapitalByOrder($order);
                $freez+=$capital['first_shop_money'];
            }
        }
        return $freez;
    }
}