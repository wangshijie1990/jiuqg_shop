<?php

namespace app\api\model\store\shop;

use app\common\model\store\shop\Setting as SettingModel;

/**
 * 门店设置模型
 * Class Setting
 * @package app\api\model\dealer
 */
class Setting extends SettingModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'update_time'
    ];

}