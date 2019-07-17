<?php

namespace app\common\service\qrcode;

use Grafika\Color;
use Grafika\Grafika;

/**
 * 每日精选二维码
 * Class Qrcode
 * @package app\common\service
 */
class DayQrcode extends Base
{

    private $shop;
    private $goodsList;
    private $user;
    /**
     * 构造方法
     * Poster constructor.
     * @param $dealer
     * @throws \Exception
     */
    public function __construct($shop,$goodsList,$user=false)
    {
        parent::__construct();
        // 分销商用户信息
        $this->shop = $shop;
        $this->user=$user;
        foreach($goodsList as $v){
            $list[]=array('goods_image'=>$v['goods_image'],'goods_name'=>$v['goods_name'],'goods_price'=>$v['goods_sku']['goods_price'],'line_price'=>$v['goods_sku']['line_price']);
        }
        $this->goodsList=$list;
    }

    /**
     * 获取分销二维码
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
        $wxappId = $this->shop['wxapp_id'];
        // 1. 下载背景图
        $backdrop=__DIR__ . '/resource/day_bg.png';
        //$backdrop = $this->saveTempImage($wxappId, 'http://shop.yewudaotech.com/assets/store/img/qrcode/backdrop.png', 'backdrop');
        // 3. 下载小程序码
        $param='shopid:' . $this->shop['shop_id'];
        if($this->user){
            $param=$param.',uid:'.$this->user['user_id'];
        }
        $qrcode = $this->saveQrcode($wxappId, $param);
        foreach($this->goodsList as $k=>$v){
            $this->goodsList[$k]['goods_image_path']=$this->saveTempImage($wxappId,$v['goods_image'],'goods');
        }
        // 4. 拼接海报图
        return $this->savePoster($backdrop, $qrcode);
    }

    /**
     * 海报图文件路径
     * @return string
     */
    private function getPosterPath()
    {
        // 保存路径
        $tempPath = WEB_PATH . 'temp' . DS . $this->shop['wxapp_id'].DS.date('Ymd').DS;
        !is_dir($tempPath) && mkdir($tempPath, 0755, true);
        return $tempPath . $this->getPosterName();
    }

    /**
     * 海报图文件名称
     * @return string
     */
    private function getPosterName()
    {
        return md5('poster_' . $this->shop['shop_id']) . '.png';
    }

    /**
     * 海报图url
     * @return string
     */
    private function getPosterUrl()
    {
        return \base_url() . 'temp/' . $this->shop['wxapp_id'] . '/'.date('Ymd').'/'. $this->getPosterName() . '?t=' . time();
    }

    /**
     * 拼接海报图
     * @param $backdrop
     * @param $avatarUrl
     * @param $qrcode
     * @return string
     * @throws \Exception
     */
    private function savePoster($backdrop,  $qrcode)
    {
        // 实例化图像编辑器
        $editor = Grafika::createEditor(['Gd']);
        // 打开海报背景图
        $editor->open($backdropImage, $backdrop);
        //
        // 生成圆形用户头像
        //$this->config['avatar']['style'] === 'circle' && $this->circular($avatarUrl, $avatarUrl);
        // 打开用户头像
        //$editor->open($avatarImage, $avatarUrl);
        // 重设用户头像宽高
        //$avatarWidth = $this->config['avatar']['width'] * 2;
        //$editor->resizeExact($avatarImage, $avatarWidth, $avatarWidth);
        // 用户头像添加到背景图
        //$avatarX = $this->config['avatar']['left'] * 2;
        //$avatarY = $this->config['avatar']['top'] * 2;
        //$editor->blend($backdropImage, $avatarImage, 'normal', 1.0, 'top-left', $avatarX, $avatarY);

        // 生成圆形小程序码
        $this->circular($qrcode, $qrcode);
        //$this->config['qrcode']['style'] === 'circle' && 
        // 打开小程序码
        $editor->open($qrcodeImage, $qrcode);
        // 重设小程序码宽高
        $qrcodeWidth = 130;
        $editor->resizeExact($qrcodeImage, $qrcodeWidth, $qrcodeWidth);
        // 小程序码添加到背景图
        $qrcodeX = -20;
        $qrcodeY = -50;
        $editor->blend($backdropImage, $qrcodeImage, 'normal', 1.0, 'bottom-right', $qrcodeX, $qrcodeY);
        $fontPath = Grafika::fontsDir() . DS . 'st-heiti-light.ttc';
        foreach($this->goodsList as $k=>$v){
            $x=($k%2==0?45:250);
            $y=180+(floor($k/2))*110;
            $this->circular($v['goods_image_path'], $v['goods_image_path']);
            $editor->open($goodsImage, $v['goods_image_path']);
            $editor->resizeExact($goodsImage, 80,80);
            $editor->blend($backdropImage, $goodsImage, 'normal', 1.0, 'top-left', $x,$y );
            $this->writeLineText($editor,$backdropImage,$v['goods_name'],2,6,$x+90, $y,$fontPath,'#000000');
            $editor->text($backdropImage, '￥'.$v['line_price'], 11, $x+90, $y+40, new Color("#000000"), $fontPath);
            $editor->draw($backdropImage, Grafika::createDrawingObject('Line', array($x+90, $y+45), array($x+150, $y+45), 1, new Color('#000000')));
            $editor->text($backdropImage, '￥'.$v['goods_price'], 11, $x+90, $y+60, new Color("#FF0000"), $fontPath);

        }
        
        $editor->text($backdropImage, '团长：'.$this->shop['shop_name'], 14, 20, 710, new Color("#FFFFFF"), $fontPath);
        $address='地址：'.($this->shop['region']['province']).($this->shop['region']['city']).($this->shop['region']['region']).($this->shop['address']);
        $this->writeLineText($editor,$backdropImage,$address,3,14,20, 740,$fontPath,'#ffffff',14);
        //$editor->text($backdropImage, $address, 11, 20, 750, new Color("#FFFFFF"), $fontPath);
        $editor->text($backdropImage, date('m月d日'), 18, 185, 118, new Color("#000000"), $fontPath);
        // 保存图片
        $editor->save($backdropImage, $this->getPosterPath(),'png');
        return $this->getPosterUrl();
    }
    private function writeLineText($editor,$image,$title,$rows,$per,$x,$y,$fontPath,$color,$fontSize=11){
        for($i=0;$i<$rows;$i++){
            $text=mb_substr($title,$i*$per,$per,'utf8');
            if($text){
                $editor->text($image, $text, $fontSize, $x,$y+$i*($fontSize+8), new Color($color), $fontPath); 
            } 
        }
        
    }
    /**
     * 生成圆形图片
     * @param static $imgpath 图片地址
     * @param string $saveName 保存文件名，默认空。
     */
    private function circular($imgpath, $saveName = '')
    {
        $srcImg = imagecreatefromstring(file_get_contents($imgpath));
        $w = imagesx($srcImg);
        $h = imagesy($srcImg);
        $w = $h = min($w, $h);
        $newImg = imagecreatetruecolor($w, $h);
        // 这一句一定要有
        imagesavealpha($newImg, true);
        // 拾取一个完全透明的颜色,最后一个参数127为全透明
        $bg = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefill($newImg, 0, 0, $bg);
        $r = $w / 2; //圆半径
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $rgbColor = imagecolorat($srcImg, $x, $y);
                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                    imagesetpixel($newImg, $x, $y, $rgbColor);
                }
            }
        }
        // 输出图片到文件
        imagepng($newImg, $saveName);
        // 释放空间
        imagedestroy($srcImg);
        imagedestroy($newImg);
    }

}