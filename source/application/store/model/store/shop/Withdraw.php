<?php

namespace app\store\model\store\shop;

use app\common\service\Message;
use app\common\service\Order as OrderService;
use app\common\library\wechat\WxPay;
use app\store\model\Wxapp as WxappModel;
use app\common\model\store\shop\Withdraw as WithdrawModel;
use app\store\model\store\Shop;
/**
 * 门店提现明细模型
 * Class Withdraw
 * @package app\store\model\dealer
 */
class Withdraw extends WithdrawModel
{
    /**
     * 获取器：申请时间
     * @param $value
     * @return false|string
     */
    public function getAuditTimeAttr($value)
    {
        return $value > 0 ? date('Y-m-d H:i:s', $value) : 0;
    }

    /**
     * 获取器：打款方式
     * @param $value
     * @return mixed
     */
    public function getPayTypeAttr($value)
    {
        return ['text' => $this->payType[$value], 'value' => $value];
    }

    /**
     * 获取分销商提现列表
     * @param null $user_id
     * @param int $apply_status
     * @param int $pay_type
     * @param string $search
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($shop_id = null, $apply_status = -1, $pay_type = -1, $search = '')
    {
        // 构建查询规则
        $this->alias('withdraw')
            ->field('withdraw.*')
            ->join('store_shop shop', 'shop.shop_id = withdraw.shop_id')
            ->field('shop.shop_name,shop.linkman,shop.phone')
            ->join('upload_file file', 'shop.logo_image_id=file.file_id')
            ->field('file.file_name')
            ->order(['withdraw.create_time' => 'desc']);
        // 查询条件
        $shop_id > 0 && $this->where('withdraw.shop_id', '=', $shop_id);
        $apply_status > 0 && $this->where('withdraw.apply_status', '=', $apply_status);
        $pay_type > 0 && $this->where('withdraw.pay_type', '=', $pay_type);
        // 获取列表数据
        return $this->paginate(15, false, [
            'query' => \request()->request()
        ]);
    }

    /**
     * 分销商提现审核
     * @param $data
     * @return bool
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function submit($data)
    {
        if ($data['apply_status'] == '30' && empty($data['reject_reason'])) {
            $this->error = '请填写驳回原因';
            return false;
        }
        // 更新申请记录
        $data['audit_time'] = time();
        $this->allowField(true)->save($data);
        // 提现驳回：解冻分销商资金
        $data['apply_status'] == '30' && Shop::backFreezeMoney($this['user_id'], $this['money']);
        // 发送模板消息
        (new Message)->withdraw($this);
        return true;
    }

    /**
     * 确认已打款
     * @return bool
     * @throws \think\exception\PDOException
     */
    public function money()
    {
        $this->startTrans();
        try {
            // 更新申请状态
            $this->allowField(true)->save([
                'apply_status' => 40,
                'audit_time' => time(),
            ]);
            // 更新分销商累积提现佣金
            Shop::totalMoney($this['shop_id'], $this['money']);
            // 记录分销商资金明细
            Capital::add([
                'shop_id' => $this['shop_id'],
                'flow_type' => 20,
                'money' => -$this['money'],
                'describe' => '申请提现',
            ]);
            // 发送模板消息
            (new Message)->withdraw($this);
            // 事务提交
            $this->commit();
            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->rollback();
            return false;
        }
    }

    /**
     * 分销商提现：微信支付企业付款
     * @return bool
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function wechatPay()
    {
        // 微信用户信息
        $user = $this['user'];

        // 生成付款订单号
        $orderNO = OrderService::createOrderNo();
        // 付款描述
        $desc = '分销商提现付款';
        // 微信支付api：企业付款到零钱
        $wxConfig = WxappModel::getWxappCache();
        $WxPay = new WxPay($wxConfig);

        // 请求付款api
        if ($WxPay->transfers($orderNO, $user['open_id'], $this['money'], $desc)) {
            // 确认已打款
            $this->money();
            return true;
        }
        return false;
    }

}