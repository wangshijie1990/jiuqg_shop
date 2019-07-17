<?php

namespace app\api\controller\user;

use think\Cache;
use app\api\controller\Controller;
use app\api\model\User as UserModel;
/**
 * 个人中心主页
 * Class WeRun
 * @package app\api\controller\user
 */
class Werun extends Controller
{
    /**
     * 获取当前用户步数信息
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function getRunData()
    {

        $model = new UserModel;
        $data=$model->getWerun($this->request->post());
        if($data){
            return $data;
        }
        return $this->renderError('解密数据失败');
    }

}
