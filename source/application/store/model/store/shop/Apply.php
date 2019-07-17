<?php

namespace app\store\model\store\shop;

use app\common\model\store\shop\Apply as ApplyModel;
use app\common\model\store\Shop as ShopModel;
use app\common\model\store\shop\Clerk as ShopClerkModel;
use app\common\service\Message;
use Lvht\GeoHash;

/**
 * 门店入驻申请模型
 * Class Apply
 * @package app\store\model\shop
 */
class Apply extends ApplyModel
{
    /**
     * 获取分销商申请列表
     * @param string $search
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($search = '')
    {
        // 构建查询规则
        $this->alias('apply')
            ->field('apply.*, user.nickName, user.avatarUrl')
            ->with(['referee','logo'])
            ->join('user', 'user.user_id = apply.user_id')
            ->order(['apply.create_time' => 'desc']);
        // 查询条件
        !empty($search) && $this->where('user.nickName|apply.real_name|apply.mobile', 'like', "%$search%");
        // 获取列表数据
        return $this->paginate(15, false, [
            'query' => \request()->request()
        ]);
    }

    /**
     * 门店入驻审核
     * @param $data
     * @return bool
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function submit($data)
    {
        
        if ($data['apply_status'] == '30' && empty($data['reject_reason'])) {
            $this->error = '请填写驳回原因';
            return false;
        }
        $data['audit_time'] = time();
        if($data['apply_status']==20){
            $status = $this->transaction(
            function () use ($data) {
                $shop_id=$this->addShop($data);
                if($shop_id){
                    $status=$this->addShopClerk($data,$shop_id);
                    $status=$this->allowField(true)->save($data);
                }
                return $status;
            });
        }
        else{
            $this->allowField(true)->save($data);
        }
        return true;
    }
    private function addShop($data){
        $coordinate = explode(',', $this->location);
        $data['latitude'] = $coordinate[0];
        $data['longitude'] = $coordinate[1];
        $Geohash = new Geohash;
        $data['geohash'] = $Geohash->encode($data['longitude'], $data['latitude']);
        $data['logo_image_id']=$this->image_id;
        $data['linkman']=$this->real_name;
        $data['phone']=$this->mobile;
        $data['shop_hours']=$this->open_time;
        $data['summary']=$this->intro;
        $data['sort']=100;
        $data['is_check']=1;
        $data['status']=1;
        $data['parent_shop_id']=$this->referee_shop_id;
        $data['shop_name']=$this->shop_name;
        $data['province_id']=$this->province_id;
        $data['city_id']=$this->city_id;
        $data['region_id']=$this->region_id;
        $data['address']=$this->address;
        $data['wxapp_id']=$this->wxapp_id;
        $model=new ShopModel;
        $model->allowField(true)->save($data);
        return $model->shop_id;
    }
    private function addShopClerk($data,$shop_id){
        $model=new ShopClerkModel;
        $data['shop_id']=$shop_id;
        $data['user_id']=$this->user_id;
        $data['real_name']=$this->real_name;
        $data['mobile']=$this->mobile;
        $data['status']=1;
        $data['wxapp_id']=$this->wxapp_id;
        return $model->allowField(true)->save($data);
    }
       

}