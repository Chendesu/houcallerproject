<?php
class Captcha{
  private $_fontfile=''; // 字体文件
  private $_size=20;   // 字体大小
  private $_width=120; // 画布宽度
  private $_height=40; // 画布高度
  private $_length=4; // 验证码长度
  private $_image=null; // 画布资源
  private $_snow=0;  // 干扰元素：雪花（*）的个数
  private $_pixel=0; // 干扰元素：像素个数
  private $_line=0;  // 干扰元素：线段个数

  /**
   * 初始化数据
   *
   * @param array $config
   */
  public function __construct($config=array())
  {
    if(is_array($config)&&count($config)>0){
      // 检测字体文件是否存在并且可读
      if(isset($config['fontfile'])&&is_file($config['fontfile'])&&is_readable($config['fontfile'])){
        $this->_fontfile=$config['fontfile'];
      } else {
        return false;
      }
      // 检测是否设置字体大小
      if (isset($config['size']) && $config['size'] > 0) {
        $this->_size = (int) $config['size'];
      }
      // 检测是否设置画布的宽高
      if(isset($config['width'])&&$config['width']>0){
        $this->_width=(int)$config['width'];
      }
      if (isset($config['height']) && $config['height'] > 0) {
        $this->_height = (int) $config['height'];
      }
      // 检测是否设置验证码长度
      if (isset($config['length']) && $config['length'] > 0) {
        $this->_length = (int) $config['length'];
      }
      // 配置干扰元素
      if(isset($config['snow'])&&$config['snow']>0){
        $this->_snow=(int)$config['snow'];
      }
      if (isset($config['pixel']) && $config['pixel'] > 0) {
        $this->_pixel = (int) $config['pixel'];
      }
      if (isset($config['line']) && $config['line'] > 0) {
        $this->_line = (int) $config['line'];
      }
      $this->_image=imagecreatetruecolor($this->_width,$this->_height);
      return $this->_image;

    } else {
      return false;
    }
  }
  /**
   * 得到验证码
   *
   * @return void
   */
  public function getCaptcha()
  {
    // 填充矩形
    $white=imagecolorallocate($this->_image,255,255,255);
    // 生成验证码
    imagefilledrectangle($this->_image,0,0,$this->_width,$this->_height,$white);
    $str=$this->_generateStr($this->_length);
    if(false===$str){
      return false;
    }
    // 绘制验证码
    $fontfile=$this->_fontfile;
    for($i=0;$i<$this->_length;$i++){
      $size=$this->_size;
      $angle=mt_rand(-30,30);
      $x=ceil($this->_width/$this->_length)*$i+mt_rand(5,10);
      $y=ceil($this->_height/1.5);
      $color=$this->_getRandColor();
      // $text=mb_substr($str,$i,1,'utf-8'); // 若验证码有汉字，则使用这句
      $text=$str{$i};
      imagettftext($this->_image,$size,$angle,$x,$y,$color,$fontfile,$text);
    }
    // 雪花、线段和像素
    if($this->_snow){
      //使用雪花当做干扰元素
      $this->_getSnow();
    } else {
      if($this->_pixel){
        $this->_getPixel();
      }
      if($this->_line){
        $this->_getLine();
      }
    }
    // 输出图像
    header('content-type:image/png');
    imagepng($this->_image);
    imagedestroy($this->_image);
    return strtolower($str);
 
  }
  /**
   * 产生雪花
   *
   * @return void
   */
  private function _getSnow()
  {
    for($i=1;$i<=$this->_snow;$i++){
      imagestring($this->_image,mt_rand(1,5),mt_rand(0,$this->_width),mt_rand(0,$this->_height),'*',$this->_getRandColor());
    }
  }
  /**
   * 绘制像素
   *
   * @return void
   */
  private function _getPixel()
  {
    for($i=1;$i<=$this->_pixel;$i++){
      imagesetpixel($this->_image,mt_rand(0,$this->_width),mt_rand(0,$this->_height),$this->_getRandColor());
    }
  }
  /**
   * 绘制线段
   *
   * @return void
   */
  private function _getLine()
  {
    for($i=1;$i<=$this->_line;$i++){
      imageline($this->_image,mt_rand(0,$this->_width),mt_rand(0,$this->_height),mt_rand(0,$this->_width),mt_rand(0,$this->_height),$this->_getRandColor());
    }
  }
  /**
   * 产生验证码字符
   *
   * @param integer $length 验证码长度
   * @return string  随机字符
   */
  private function _generateStr($length=4)
  {
    if($length<1||$length>30){
      return false;
    }
    $chars=array(
      'a','b','c','d','e','f','g','h','k','m','n','p','x','y','z',
      'A','B','C','D','E','F','G','H','K','M','N','P','X','Y','Z',
      1,2,3,4,5,6,7,8,9
    );
    $str = join('',array_rand(array_flip($chars),$length));
    return $str;
  }
  private function _getRandColor(){
    return imagecolorallocate($this->_image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
  }

}