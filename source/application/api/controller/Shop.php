<?php

namespace app\api\controller;

use app\api\model\store\Shop as ShopModel;


/**
 * 门店列表
 * Class Shop
 * @package app\api\controller
 */
class Shop extends Controller
{
    /**
     * 门店列表
     * @param string $longitude
     * @param string $latitude
     * @return array
     * @throws \think\exception\DbException
     */
    public function lists($longitude = '', $latitude = '',$keyword='')
    {
        $model = new ShopModel;
        $list = $model->getList(true, $longitude, $latitude,false,$keyword);
        //$sql=$model->getLastsql();
        return $this->renderSuccess(compact('list'));
    }

    /**
     * 门店详情
     * @param $shop_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function detail($shop_id,$longitude='',$latitude='')
    {
        $detail = ShopModel::detail($shop_id);
        //dump($detail);
        if($longitude && $latitude){
            $distance=ShopModel::getDistance(floatval($detail['longitude']), floatval($detail['latitude']), floatval($longitude), floatval($latitude));
            if ($distance >= 1000) {
                $distance = bcdiv($distance, 1000, 2);
                $detail['distance_unit'] = $distance . 'km';
            } 
            else{
                $detail['distance_unit'] = $distance . 'm';
            }
        }
        return $this->renderSuccess(compact('detail'));
    }
    
}