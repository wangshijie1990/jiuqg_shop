<?php

namespace app\store\controller\shop;

use app\store\controller\Controller;
use app\store\model\store\shop\Apply as ApplyModel;

/**
 * 门店申请
 * Class Setting
 * @package app\store\controller\apps\dealer
 */
class Apply extends Controller
{
    /**
     * 门店申请列表
     * @param string $search
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index($search = '')
    {
        $model = new ApplyModel;
        return $this->fetch('index', [
            'list' => $model->getList($search),
        ]);
    }

    /**
     * 门店申请审核
     * @param $apply_id
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function submit($apply_id)
    {
        $model = ApplyModel::detail($apply_id);
        if ($model->submit($this->postData('apply'))) {
            return $this->renderSuccess('操作成功');
        }
        return $this->renderError($model->getError() ?: '操作失败');
    }

}