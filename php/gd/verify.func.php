<?php
header('content-type:text/html;charset=utf-8');
/**
 * 默认产生4位数字的验证码
 *
 * @param integer $codeName  存入session的名字
 * @param integer $width  画布宽度
 * @param integer $height 画布高度
 * @param integer $type   1：数字；2：字母；3：数字+字母；4：汉字
 * @param integer $length 验证码长度
 * @param integer $pixel  干扰元素：像素点
 * @param integer $line   干扰元素：线段
 * @param integer $arc    干扰元素：弧线
 * @return void
 */
function getVerify($codeName='verifyCode', $width = 200, $height = 50,$type=1,$length=4,$pixel=0,$line=0,$arc=0){
  // 创建画布
  // $width=200;
  // $height=50;
  $image=imagecreatetruecolor($width,$height);
  // 创建颜色
  $white=imagecolorallocate($image,255,255,255);
  // 创建填充矩形
  imagefilledrectangle($image,0,0,$width,$height,$white);
  function getRandColor($image)
  {
    return imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
  }
  /**
   * 默认是4位的数字的验证码
   * 1-数字
   * 2-字母
   * 3-数字+字母
   * 4-汉字
   */
  // $type=1;
  // $length=4;
  switch ($type) {
    case 1:
      //数字
      $string=join('',array_rand(range(0,9),$length));
      break;
    case 2:
      //字母
      $string=join('',array_rand(array_flip(array_merge(range('a','z'),range('A','Z'))),$length));
      break;
    case 3:
      //数字+字母
      $string = join('', array_rand(array_flip(array_merge(range('a', 'z'), range('A', 'Z'),range(0,9))), $length));
      break;
    case 4:
      //汉字
      $str= '人,之,初,性,本,善,性,相,近,习,相,远,苟,不,教,性,乃,迁,教,之,道,贵,以,专,昔,孟,母,择,邻,处,子,不,学,断,机,杼,窦,燕,山,有,义,方,教,五,子,名,俱,扬,养,不,教,父,之,过,教,不,严,师,之,惰,子,不,学,非,所,宜,幼,不,学,老,何,为,玉,不,琢,不,成,器,人,不,学,不,知,义,为,人,子,方,少,时,亲,师,友,习,礼,仪,香,九,龄,能,温,席,孝,于,亲,所,当,执';
      $arr=explode(',',$str);
      $string=join('',array_rand(array_flip($arr),$length));
      break;
    default:
      exit('非法参数');
      break;
  }
  // 将验证码存入session
  session_start();
  $_SESSION[$codeName]=$string;
  
  for($i=0;$i<$length;$i++){
    $size=mt_rand(20,28);
    $angle=mt_rand(-15,15);
    $x=20+ceil($width/$length)*$i;
    $y=mt_rand(ceil($height/3),$height-20);
    $color=getRandColor($image);
    if($type==4){
      $fontFile = __DIR__ . '\fonts\msyh.ttc';
    } else {
      $fontFile = __DIR__ . '\fonts\AllerDisplay.ttf';
    }
    $text=mb_substr($string,$i,1,'utf-8');
    imagettftext($image,$size,$angle,$x,$y,$color,$fontFile,$text);
  }
  // $pixel=50;
  // $line=3;
  // $arc=2;
  // 添加像素当干扰元素
  if($pixel>0){
    for($i=1;$i<= $pixel;$i++){
      imagesetpixel($image,mt_rand(0,$width), mt_rand(0, $height),getRandColor($image));
    }
  }
  // 添加线段当做干扰元素
  if($line>0){
    for($i=1;$i<=$line;$i++){
      imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
    }
  }
  // 添加弧线
  if($arc>0){
    for($i=1;$i<=$arc;$i++){
      imagearc($image,mt_rand(0,$width/2),mt_rand(0,$height/2),mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,360),mt_rand(0,360),getRandColor($image));
    }
  }
  
  header('content-type:image/png');
  imagepng($image);
  imagedestroy($image);
}
// getVerify();
