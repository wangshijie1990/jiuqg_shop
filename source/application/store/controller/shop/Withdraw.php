<?php

namespace app\store\controller\shop;

use app\store\controller\Controller;
use app\store\model\store\Shop as ShopModel;
use app\store\model\store\shop\Withdraw as WithdrawModel;

/**
 * 门店提现申请
 * Class Setting
 * @package app\store\controller\store\shop
 */
class Withdraw extends Controller
{
    /**
     * 提现记录列表
     * @param int $shop_id
     * @param int $apply_status
     * @param int $pay_type
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index($shop_id = null, $apply_status = -1, $pay_type = -1)
    {
        $model = new WithdrawModel;
        $shopList = (new ShopModel)->getList();
        return $this->fetch('index', [
            'list' => $model->getList($shop_id, $apply_status, $pay_type),
            'shopList'=>$shopList
        ]);
    }

    /**
     * 提现审核
     * @param $id
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function submit($id)
    {
        $model = WithdrawModel::detail($id);

        if ($model->submit($this->postData('withdraw'))) {
            return $this->renderSuccess('操作成功');
        }
        return $this->renderError($model->getError() ?: '操作失败');
    }

    /**
     * 确认打款
     * @param $id
     * @return array
     * @throws \think\exception\DbException
     */
    public function money($id)
    {
        $model = WithdrawModel::detail($id);
        if ($model->money()) {
            return $this->renderSuccess('操作成功');
        }
        return $this->renderError($model->getError() ?: '操作失败');
    }

    /**
     * 分销商提现：微信支付企业付款
     * @param $id
     * @return array|bool
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function wechat_pay($id)
    {
        $model = WithdrawModel::detail($id);
        if ($model->wechatPay()) {
            return $this->renderSuccess('操作成功');
        }
        return $this->renderError($model->getError() ?: '操作失败');
    }

}