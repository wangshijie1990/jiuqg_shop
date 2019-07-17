<?php

namespace app\api\controller;

use app\api\model\WxappPage;
use app\common\service\qrcode\DayQrcode;
use app\api\model\store\Shop as ShopModel;
use app\api\model\Goods as GoodsModel;
/**
 * 页面控制器
 * Class Index
 * @package app\api\controller
 */
class Page extends Controller
{
    /**
     * 页面数据
     * @param null $page_id
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index($page_id = null)
    {
        // 页面元素
        $data = WxappPage::getPageData($this->getUser(true), $page_id);
        return $this->renderSuccess($data);
    }

    /**
     * 首页diy数据 (即将废弃)
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function home()
    {
        // 页面元素
        $data = WxappPage::getPageData($this->getUser(false));
        return $this->renderSuccess($data);
    }

    /**
     * 自定义页数据 (即将废弃)
     * @param $page_id
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function custom($page_id)
    {
        // 页面元素
        $data = WxappPage::getPageData($this->getUser(false), $page_id);
        return $this->renderSuccess($data);
    }
    /**
        获取每日精选商品海报
    */
    public function qrcode($shop_id){
        $shop=ShopModel::detail($shop_id);
        $model=new GoodsModel();
        $goodsList=$model->getlist(array('listRows'=>8));
        $Qrcode = new DayQrcode($shop,$goodsList,$this->getUser(false));
        return $this->renderSuccess([
            // 二维码图片地址
            'qrcode' => $Qrcode->getImage(),
        ]);
    }
}
