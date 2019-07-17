<?php

namespace app\common\model\store\shop;

use app\common\model\BaseModel;

/**
 * 分销商资金明细模型
 * Class Apply
 * @package app\common\model\dealer
 */
class Capital extends BaseModel
{
    protected $name = 'store_shop_capital';

    /**
     * 分销商资金明细
     * @param $data
     */
    public static function add($data)
    {
        $model = new static;
        $model->save(array_merge([
            'wxapp_id' => $model::$wxapp_id
        ], $data));
    }
}