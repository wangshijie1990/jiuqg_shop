<?php

namespace app\common\model\store;

use app\common\model\BaseModel;
use app\common\model\Region as RegionModel;
use app\common\model\store\shop\Capital;

/**
 * 商家门店模型
 * Class Shop
 * @package app\common\model\store
 */
class Shop extends BaseModel
{
    protected $name = 'store_shop';

    /**
     * 追加字段
     * @var array
     */
    protected $append = ['region'];

    /**
     * 关联文章封面图
     * @return \think\model\relation\HasOne
     */
    public function logo()
    {
        $module = self::getCalledModule() ?: 'common';
        return $this->hasOne("app\\{$module}\\model\\UploadFile", 'file_id', 'logo_image_id');
    }

    /**
     * 地区名称
     * @param $value
     * @param $data
     * @return array
     */
    public function getRegionAttr($value, $data)
    {
        return [
            'province' => RegionModel::getNameById($data['province_id']),
            'city' => RegionModel::getNameById($data['city_id']),
            'region' => $data['region_id'] == 0 ? '' : RegionModel::getNameById($data['region_id']),
        ];
    }

    /**
     * 门店详情
     * @param $shop_id
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function detail($shop_id)
    {
        return static::get($shop_id, ['logo']);
    }
     /**
     * 发放门店佣金
     * @param $shop_id
     * @param $money
     * @return bool
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public static function grantMoney($shop_id, $money,$memo)
    {
        // 门店详情
        $model = static::detail($shop_id);
        if (!$model || $model['is_delete']) {
            return false;
        }
        // 累积分销商可提现佣金
        $model->setInc('money', $money);
        // 记录分销商资金明细
        Capital::add([
            'shop_id' => $shop_id,
            'flow_type' => 10,
            'money' => $money,
            'describe' => $memo?$memo:'订单门店佣金结算',
            'wxapp_id' => $model['wxapp_id'],
        ]);
        return true;
    }
     /**
     * 资金冻结
     * @param $money
     * @return false|int
     */
    public function freezeMoney($money)
    {
        return $this->save([
            'money' => $this['money'] - $money,
            'freeze_money' => $this['freeze_money'] + $money,
        ]);
    }
}