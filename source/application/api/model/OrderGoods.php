<?php

namespace app\api\model;

use app\common\model\OrderGoods as OrderGoodsModel;

/**
 * 订单商品模型
 * Class OrderGoods
 * @package app\api\model
 */
class OrderGoods extends OrderGoodsModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'content',
        'wxapp_id',
        'create_time',
    ];

    /**
     * 获取未评价的商品
     * @param $order_id
     * @return OrderGoods[]|false
     * @throws \think\exception\DbException
     */
    public static function getNotCommentGoodsList($order_id)
    {
        return self::all(['order_id' => $order_id, 'is_comment' => 0], ['orderM', 'image']);
    }
    public   function getCurrentBuyGoodsList($limit=20){
        $list=$this->alias('ordergoods')->join('user','ordergoods.user_id=user.user_id')->join('goods','ordergoods.goods_id=goods.goods_id','right')->Where('goods.is_delete',0)->limit($limit)->field('user.avatarUrl as avatar,user.nickName as username,ordergoods.goods_id,ordergoods.goods_name')->select();
        return $list;
    }

}
