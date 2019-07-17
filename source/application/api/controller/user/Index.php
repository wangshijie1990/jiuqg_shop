<?php

namespace app\api\controller\user;

use app\api\controller\Controller;
use app\api\model\Order as OrderModel;
use app\api\model\UserCoupon as UserCouponModel;
use app\common\service\qrcode\ExtractQrcode as ExtractQrcodeModel;
/**
 * 个人中心主页
 * Class Index
 * @package app\api\controller\user
 */
class Index extends Controller
{
    /**
     * 获取当前用户信息
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function detail()
    {
        // 当前用户信息
        $user = $this->getUser();
        // 订单总数
        $model = new OrderModel;
        $qrcodeModel=new ExtractQrcodeModel($user);
        return $this->renderSuccess([
            'userInfo' => $user,
            'orderCount' => [
                'payment' => $model->getCount($user['user_id'], 'payment'),
                'received' => $model->getCount($user['user_id'], 'transfer'),
                'transfer' => $model->getCount($user['user_id'], 'transfer'),
                'comment' => $model->getCount($user['user_id'], 'comment'),
            ],
            'couponCount'=> (new UserCouponModel)->getCount($user['user_id']),
            'qrcodeUrl'=>($qrcodeModel->getImage()),
            'menus' => $user->getMenus()   // 个人中心菜单列表
        ]);
    }

}
