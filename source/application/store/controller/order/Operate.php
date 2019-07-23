<?php

namespace app\store\controller\order;

use app\store\controller\Controller;
use app\store\model\Order as OrderModel;
use app\store\model\Express as ExpressModel;

/**
 * 订单操作控制器
 * Class Operate
 * @package app\store\controller\order
 */
class Operate extends Controller
{
    /* @var OrderModel $model */
    private $model;

    /**
     * 构造方法
     * @throws \app\common\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new OrderModel;
    }

    /**
     * 订单导出
     * @param string $dataType
     * @throws \think\exception\DbException
     */
    public function export($dataType)
    {   
        return $this->model->exportList($dataType, $this->request->param());
    }
	/**
     * 订单打印
     * @param $order_data
     * @throws \think\exception\DbException
     */
    public function printOrder($order_data)
    {
        $orderInfo = $this->model->printList($order_data['dataType'], $order_data);
      	$repenseData = array(
        	'linkman' => '陈洪刚',
          	'create_time'=>date("Y-m-d",time()),
          	'finish_time'=>date("Y-m-d",time()),
        );
      	$repenseData['html'] = '<div id="form"><table border="1"  cellpadding="0" cellspacing="0" style="text-align: center;margin: 0 auto;line-height: 40px;" width="100%">
            <caption>
                    <h3>采购单</h3>
                    <div style="display: flex;justify-content: space-between;">
                        <span>创建时间:'.$repenseData['create_time'].'</span>
                        <span>计划交货日期:'.$repenseData['finish_time'].'</span>
                        <span>采购员:'.$repenseData['linkman'].'</span>
                    </div>
            </caption>
        <tr>
            <td>序号</td>
            <td>商品名称</td>
            <td>单位</td>
            <td>订单汇总量</td>
            <td>采购数</td>
        </tr>';
        foreach($orderInfo as $key=>$val){
        	$repenseData['html'] .="<tr>
            <td>".($key+1)."</td>
            <td>".$val['goods_name']."</td>
            <td>份</td>
            <td></td>
            <td>".$val['total_num']."</td>
        </tr>" ;   
        }
      	$repenseData['html'] .= '</table></div>';
        return json($repenseData);
    }
  
    /**
     * 批量发货
     * @return array|bool|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function batchDelivery()
    {
        if (!$this->request->isAjax()) {
            return $this->fetch('batchDelivery', [
                'express_list' => ExpressModel::getAll()
            ]);
        }
        if ($this->model->batchDelivery($this->postData('order'))) {
            return $this->renderSuccess('发货成功');
        }
        return $this->renderError($this->model->getError() ?: '发货失败');
    }
     /**
     * 批量配送
     * @return array|bool|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function batchTransfer()
    {
        if (!$this->request->isAjax()) {
            return $this->fetch('batchTransfer');
        }
        if ($this->model->batchTransfer($this->postData('order'))) {
            return $this->renderSuccess('配送成功');
        }
        return $this->renderError($this->model->getError() ?: '配送失败');
    }
    /**
     * 批量发货模板
     */
    public function deliveryTpl()
    {
        return $this->model->deliveryTpl();
    }
    /**
     * 批量配送模板
     */
    public function transferTpl()
    {
        return $this->model->transferTpl();
    }
    /**
     * 审核：用户取消订单
     * @param $order_id
     * @return array|bool
     * @throws \think\exception\DbException
     */
    public function confirmCancel($order_id)
    {
        $model = OrderModel::detail($order_id);
        if ($model->confirmCancel($this->postData('order'))) {
            return $this->renderSuccess('操作成功');
        }
        return $this->renderError($model->getError() ?: '操作失败');
    }

    /**
     * 门店自提核销
     * @param $order_id
     * @return array|bool
     * @throws \think\exception\DbException
     */
    public function extract($order_id)
    {
        $model = OrderModel::detail($order_id);
        $data = $this->postData('order');
        if ($model->verificationOrder($data['extract_clerk_id'])) {
            return $this->renderSuccess('核销成功');
        }
        return $this->renderError($model->getError() ?: '核销失败');
    }

}
