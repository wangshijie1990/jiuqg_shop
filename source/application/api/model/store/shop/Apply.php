<?php

namespace app\api\model\store\shop;

use app\common\model\store\shop\Apply as ApplyModel;
use app\api\model\store\shop\Clerk as ClerkModel;
use app\common\model\Region;

/**
 * 门店申请模型
 * Class Apply
 * @package app\api\model\dealer
 */
class Apply extends ApplyModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'create_time',
        'update_time',
    ];

    /**
     * 是否为门店申请中
     * @param $user_id
     * @return bool
     * @throws \think\exception\DbException
     */
    public static function isApplying($user_id)
    {
        $detail = self::detail(['user_id' => $user_id]);
        return $detail ? ((int)$detail['apply_status'] === 10) : false;
    }

    /**
     * 提交申请
     * @param $user
     * @param $data
     * @return bool
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function submit($user, $data)
    {
        if ($data['referee_id'] > 0 && ($referee = ClerkModel::get(array('user_id'=>$data['referee_id'],'is_delete'=>0)))){
            $shop_id=$referee['shop_id'];
        }
        else{
            $shop_id=0;
        }
        $region = explode(',', $data['region']);
        $province_id = Region::getIdByName($region[0], 1);
        $city_id = Region::getIdByName($region[1], 2, $province_id);
        $region_id = Region::getIdByName($region[2], 3, $city_id);
        //前台提交过来的坐标是反的处理一下
        //$location=implode(',',array_reverse(explode(',',$data['location'])));
        $data = [
            'user_id' => $user['user_id'],
            'real_name' => trim($data['real_name']),
            'mobile' => trim($data['mobile']),
            'referee_id' => intval($data['referee_id']),
            'apply_type' => 10,
            'apply_time' => time(),
            'wxapp_id' => self::$wxapp_id,
            'location'=>$data['location'],
            'address'=>$data['address'],
            'referee_shop_id'=>$shop_id,
            'intro'=>$data['intro'],
            'open_time'=>$data['open_time'],
            'image_id'=>$data['image_id'],
            'shop_name'=>$data['shop_name'],
            'region_id'=>$region_id,
            'city_id'=>$city_id,
            'province_id'=>$province_id

        ];
        $data['apply_status'] = 10;
        
        return $this->add($user, $data);
    }

    /**
     * 更新门店申请信息
     * @param $user
     * @param $data
     * @return bool
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    private function add($user, $data)
    {
        // 实例化模型
        $model = self::detail(['user_id' => $user['user_id']]) ?: $this;
        // 更新记录
        $this->startTrans();
        try {
            // $data['create_time'] = time();
            // 保存申请信息
            $model->save($data);
            $this->commit();
            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->rollback();
            return false;
        }
    }

}
