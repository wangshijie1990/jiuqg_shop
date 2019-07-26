<?php

namespace app\store\controller\order;

use app\store\controller\Controller;
use app\store\model\Order as OrderModel;
use app\store\model\Express as ExpressModel;
use think\Db;

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
     * 采购订单打印
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
 * 分拣单打印
 * @param $order_data
 * @throws \think\exception\DbException
 */
    public function sortPrintOrder($order_data)
    {
        $orderInfo = $this->model->getListAll($order_data['dataType'], $order_data)->toArray();
        $repenseData = [];
        foreach ($orderInfo as $key=>$val){
            foreach ($val['goods'] as $m=>$n){
                //获取自提信息
                $liftInfo =  Db::table('yoshop_order_extract')->where('order_id', '=',$val['order_id'])->field('linkman,phone')->find();
                $repenseData[]['html'] = '<ul style="line-height:60px; list-style:none;"><li>商品名称：'.$n['goods_name'].'</li><li>配送日期：'.date('m/d',time()).'</li><li>数量：×'.$n['total_num'].'</li><li>单位：份</li><li>会员：'.$liftInfo['linkman'].'</li><li>电话：'.$liftInfo['phone'].'</li><li>团长：'.$val['extract_shop']['shop_name'].'</li></ul>';
            }
        }
        return json($repenseData);
    }
    /**
     * 配送单打印
     * @param $order_data
     * @throws \think\exception\DbException
     */
    public function sendPrintOrder($order_data)
    {
        $orderInfo = $this->model->getListAll($order_data['dataType'], $order_data)->toArray();
        $data = [];
        $shopArr = [];
        foreach ($orderInfo as $v){
            $shopInfo = $v['extract_shop'];
            //获取自提信息
            $liftInfo =  Db::table('yoshop_order_extract')->where('order_id', '=',$v['order_id'])->field('linkman,phone')->find();
            //判断店铺是否重复
            if(in_array($shopInfo['shop_id'],$shopArr)){
                foreach ($v['goods'] as $val){
                    $data[$shopInfo['shop_id']]['goods'][]= [
                        'linkman'=>$liftInfo['linkman'],
                        'phone'=>$liftInfo['phone'],
                        'goods_name'=>$val['goods_name'],
                        'total_num'=>$val['total_num'],
                        'goods_price'=>$val['goods_price'],
                        'total_price'=>$val['total_price']
                    ];
                }
                continue;
            }
            $shopArr[] = $shopInfo['shop_id'];
            $data[$shopInfo['shop_id']]=[
                'shop_name'=>$shopInfo['shop_name'],
                'linkman'=>$shopInfo['linkman'],
                'phone'=>$shopInfo['phone'],
                'address'=>$shopInfo['address'],
                'region'=>$shopInfo['region']['region'],
                'send_time'=>date('Y-m-d',time()),
            ];
            foreach ($v['goods'] as $val){
                $data[$shopInfo['shop_id']]['goods'][] = [
                    'linkman'=>$liftInfo['linkman'],
                    'phone'=>$liftInfo['phone'],
                    'goods_name'=>$val['goods_name'],
                    'total_num'=>$val['total_num'],
                    'goods_price'=>$val['goods_price'],
                    'total_price'=>$val['total_price']
                ];
            }
        }
        $repenseData = [];
        $i=0;
        foreach ($data as $key=>$val){
            $repenseData[$i]['html'] = '<table border="1"  cellpadding="0" cellspacing="0" style="text-align: center;margin: 0 auto;line-height: 30px;font-size: 16px" width="100%">
            <caption>
                    <h3>配送单</h3>
                    <div style="display: flex;justify-content: space-between;">
                        <span>自提店名称:'.$val['shop_name'].'</span>
                        <span>配送日期:'.$val['send_time'].'</span>
                        <span>配送区域：'.$val['region'].'</span>
                    </div>
                    <div style="text-align: left">
                        <span style="margin-right: 20px">团长:'.$val['linkman'].'</span>
                        <span>团长手机:'.$val['phone'].'</span>
                    </div>
                    <div style="text-align: left">
                        <span>详细地址:'.$val['address'].'</span>
                    </div>
            </caption> 
            <tr>
                <td>序号</td>
                <td>会员名称</td>
                <td>会员手机</td>
                <td>商品名称</td>
                <td>订购数量</td>
                <td>取货</td>
                <td>订购单价</td>
                <td>下单小计</td>
            </tr>';
            $num = count($val['goods']);
            foreach ($val['goods'] as $m=>$n){
                if($m>=25) break;
                $repenseData[$i]['html'] .='<tr>
                    <td>'.($m+1).'</td>
                    <td>'.$n['linkman'].'</td>
                    <td>'.$n['phone'].'</td>
                    <td style="line-height:18px;">'.$n['goods_name'].'</td>
                    <td>'.$n['total_num'].'</td>
                    <td><input type="checkbox"/></td>
                    <td>￥'.$n['goods_price'].'</td>
                    <td>￥'.$n['total_price'].'</td>
                </tr>' ;
            }
            $repenseData[$i]['html'] .= '</table>';
            $times = ceil($num/25)-1;
            if($times>0){
                for ($time=1;$time<=$times;$time++){
                    $repenseData[$i+$time]['html'] = '<table border="1"  cellpadding="0" cellspacing="0" style="text-align: center;margin: 0 auto;line-height: 30px;font-size: 16px" width="100%">';
                    for($j=(25*$time+1);$j<=25*($time+1);$j++){
                            if($j>=$num) break;
                            $repenseData[$i+$time]['html'] .='<tr>
                                <td width="30px">'.($j).'</td>
                                <td width="80px">'.$val['goods'][$j]['linkman'].'</td>
                                <td>'.$val['goods'][$j]['phone'].'</td>
                                <td style="line-height:18px;">'.$val['goods'][$j]['goods_name'].'</td>
                                <td width="60px">'.$val['goods'][$j]['total_num'].'</td>
                                <td><input type="checkbox"/></td>
                                <td>￥'.$val['goods'][$j]['goods_price'].'</td>
                                <td>￥'.$val['goods'][$j]['total_price'].'</td>
                            </tr>' ;
                    }
                }
                $repenseData[$i]['html'] .= '</table>';
                $i += $time+1;
            }
            $i += 1;
        }

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
