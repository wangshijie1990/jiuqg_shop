<?php

namespace app\common\model\store\shop;

use think\Hook;
use app\common\model\BaseModel;
use app\common\enum\OrderType as OrderTypeEnum;
use app\common\model\store\Shop as ShopModel;
use think\Log;

/**
 * 商家门店核销订单记录模型
 * Class Clerk
 * @package app\common\model\store
 */
class Order extends BaseModel
{
    protected $name = 'store_shop_order';
    protected $updateTime = false;
    /**
     * 订单模型初始化
     */
    public static function init()
    {
        parent::init();
        // 监听分销商订单行为管理
        $static = new static;
        Hook::listen('ShopOrder', $static);
    }
    /**
     * 关联门店表
     * @return \think\model\relation\BelongsTo
     */
    public function shop()
    {
        $module = static::getCalledModule() ?: 'common';
        return $this->BelongsTo("app\\{$module}\\model\\store\\Shop");
    }

    /**
     * 关联店员表
     * @return \think\model\relation\BelongsTo
     */
    public function clerk()
    {
        $module = static::getCalledModule() ?: 'common';
        return $this->BelongsTo("app\\{$module}\\model\\store\\shop\\Clerk");
    }

    /**
     * 订单类型
     * @param $value
     * @return array
     */
    public function getOrderTypeAttr($value)
    {
        $types = OrderTypeEnum::getTypeName();
        return ['text' => $types[$value], 'value' => $value];
    }

    /**
     * 新增核销记录
     * @param int $order_id 订单id
     * @param int $shop_id 门店id
     * @param int $clerk_id 核销员id
     * @param int $order_type
     * @return mixed
     */
    public static function add(
        $order_id,
        $shop_id,
        $clerk_id,
        $order_type = OrderTypeEnum::MASTER
    )
    {
        return (new static)->save([
            'order_id' => $order_id,
            'order_type' => $order_type,
            'shop_id' => $shop_id,
            'clerk_id' => $clerk_id,
            'wxapp_id' => static::$wxapp_id
        ]);
    }
    /**
     * 发放门店订单佣金
     * @param array|\think\Model $order 订单详情
     * @param int $orderType 订单类型
     * @return bool|false|int
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public static function grantMoney(&$order, $orderType = OrderTypeEnum::MASTER)
    {
        // 订单是否已完成
        if ($order['order_status']['value'] != 30) {
            return false;
        }
        // 佣金结算天数
        $settleDays = Setting::getItem('settlement', $order['wxapp_id'])['settle_days'];
        // 判断该订单是否满足结算时间 (订单完成时间 + 佣金结算时间) ≤ 当前时间
        $deadlineTime = $order['receipt_time'] + ((int)$settleDays * 86400);
        if ($settleDays > 0 && $deadlineTime > time()) {
            return false;
        }
        // 门店订单详情
        $model = self::detail(['order_id' => $order['order_id'], 'order_type' => $orderType]);
        if (!$model || $model['is_settled'] == 1) {
            return false;
        }
        
        // 重新计算门店佣金
        $capital = $model->getCapitalByOrder($order);
        //Log::write($capital);
        $capital['first_shop_money']>0 && ShopModel::grantMoney($model['shop_id'], $capital['first_shop_money'],'订单门店一级佣金结算');
        
        $shop=ShopModel::detail($model['shop_id']);

        if($shop['parent_shop_id']>0){
           $capital['second_shop_money']>0 && ShopModel::grantMoney($shop['parent_shop_id'], $capital['second_shop_money'],'订单门店二级佣金结算'); 
        }
       
        // 更新门店订单记录
        $bl=$model->save([
            //'order_price' => $capital['orderPrice'],
            'first_shop_money' => $capital['first_shop_money'],
            'second_shop_money' => $capital['second_shop_money'],
            'money' => ($capital['first_shop_money']+$capital['second_shop_money']),
            'is_settled' => 1,
            'settle_time' => time()
        ]);
        
    
        return $bl;
    }
    
    /**
     * 订单详情
     * @param $where
     * @return Order|null
     * @throws \think\exception\DbException
     */
    public static function detail($where)
    {
        return static::get($where);
    }
    /**
     * 计算订单门店佣金
     * @param $order
     * @return array
     */
    protected function getCapitalByOrder(&$order)
    {
        //Log::write($order);
        // 分销佣金设置
        $setting = Setting::getItem('commission', $order['wxapp_id']);
       
        // 分销订单佣金数据
        $capital = [
            // 订单总金额(不含运费)
            'orderPrice' => bcsub($order['pay_price'], $order['express_price'], 2),
            // 一级门店分润佣金
            'first_shop_money' => 0.00,
            // 二级分销佣金
            'second_shop_money' => 0.00,
        ];

        // 计算分销佣金
        foreach ($order['goods'] as $goods) {
            // 判断商品存在售后退款则不计算佣金
           
            if ($this->checkGoodsRefund($goods)) {
                continue;
            }
           
            // 商品实付款金额
            $goodsPrice = min($capital['orderPrice'], $goods['total_pay_price']);
            // 计算商品实际佣金
            
            $goodsCapital = $this->calculateGoodsCapital($setting, $goods, $goodsPrice);
            
            // 累积分销佣金
            $capital['first_shop_money'] += $goodsCapital['first_shop_money'];
            $capital['second_shop_money'] += $goodsCapital['second_shop_money'];
        }
        
        return $capital;
    }
    /**
     * 计算商品实际佣金
     * @param $setting
     * @param $goods
     * @param $goodsPrice
     * @return array
     */
    private function calculateGoodsCapital($setting, $goods, $goodsPrice)
    {
        // 判断是否开启商品单独分销
        if ($goods['is_ind_shop'] == false) {
            // 全局分销比例
            return [
                'first_shop_money' => $goodsPrice * ($setting['first_money'] * 0.01),
                'second_shop_money' => $goodsPrice * ($setting['second_money'] * 0.01)
            ];
        }
        
        // 商品单独分销
        if ($goods['shop_money_type'] == 10) {
            // 分销佣金类型：百分比
            return [
                'first_shop_money' => $goodsPrice * ($goods['first_shop_money'] * 0.01),
                'second_shop_money' => $goodsPrice * ($goods['second_shop_money'] * 0.01)
            ];
        } else {
            return [
                'first_shop_money' => $goods['total_num'] * $goods['first_shop_money'],
                'second_shop_money' => $goods['total_num'] * $goods['second_shop_money']
            ];
        }
        
    }
    /**
     * 验证商品是否存在售后
     * @param $goods
     * @return bool
     */
    private function checkGoodsRefund(&$goods)
    {
        return !empty($goods['refund'])
            && $goods['refund']['type']['value'] == 10
            && $goods['refund']['is_agree']['value'] != 20;
    }
}