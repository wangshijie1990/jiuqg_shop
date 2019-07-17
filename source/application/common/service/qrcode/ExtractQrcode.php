<?php

namespace app\common\service\qrcode;



/**
 * 提货二维码
 * Class Qrcode
 * @package app\common\service
 */
class ExtractQrcode extends Base
{

   private $user;
    /**
     * 构造方法
     * Poster constructor.
     * @param $dealer
     * @throws \Exception
     */
    public function __construct($user)
    {
        parent::__construct();
        // 用户信息
        $this->user = $user;
    }

    /**
     * 获取提货二维码
     * @return string
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     * @throws \Exception
     */
    public function getImage()
    {
        if (file_exists($this->getPosterPath())) {
            return $this->getPosterUrl();
        }
        // 小程序id
        $wxappId = $this->user['wxapp_id'];
        
        // 3. 下载小程序码
        $qrcode = $this->saveQrcode($wxappId, 'uid:'.$this->user['user_id'],'pages/store/check/all');
        copy($qrcode,$this->getPosterPath());
        return $this->getPosterUrl();
        //return $this->savePoster($backdrop, $qrcode);
    }

    /**
     * 海报图文件路径
     * @return string
     */
    private function getPosterPath()
    {
        // 保存路径
        $tempPath = WEB_PATH . 'temp' . DS . $this->user['wxapp_id'].DS;
        !is_dir($tempPath) && mkdir($tempPath, 0755, true);
        return $tempPath . $this->getPosterName();
    }

    /**
     * 海报图文件名称
     * @return string
     */
    private function getPosterName()
    {
        return md5('extract_' . $this->user['user_id']) . '.png';
    }

    /**
     * 海报图url
     * @return string
     */
    private function getPosterUrl()
    {
        return \base_url() . 'temp/' . $this->user['wxapp_id'] .'/'. $this->getPosterName() . '?t=' . time();
    }

    
}