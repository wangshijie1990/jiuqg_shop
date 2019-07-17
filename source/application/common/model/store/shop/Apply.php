<?php

namespace app\common\model\store\shop;

use app\common\model\Region as RegionModel;
use app\common\model\BaseModel;

/**
 * 门店申请模型
 * Class Apply
 * @package app\common\model\store\shop
 */
class Apply extends BaseModel
{
    protected $name = 'store_shop_apply';
    protected $append = ['region'];
    /**
     * 申请状态
     * @var array
     */
    public $applyStatus = [
        10 => '待审核',
        20 => '审核通过',
        30 => '驳回',
    ];

    /**
     * 获取器：申请时间
     * @param $value
     * @return false|string
     */
    public function getApplyTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    /**
     * 获取器：审核时间
     * @param $value
     * @return false|string
     */
    public function getAuditTimeAttr($value)
    {
        return $value > 0 ? date('Y-m-d H:i:s', $value) : 0;
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
     * 关联推荐人表
     * @return \think\model\relation\BelongsTo
     */
    public function referee()
    {
        return $this->belongsTo('app\common\model\User', 'referee_id')
            ->field(['user_id', 'nickName']);
    }
    /*关联LOGO*/
    public function logo()
    {
        return $this->hasOne("app\common\model\UploadFile", 'file_id', 'image_id');
    }
    /**
     * 门店申请记录详情
     * @param $where
     * @return Apply|static
     * @throws \think\exception\DbException
     */
    public static function detail($where)
    {
        return self::get($where);
    }
}