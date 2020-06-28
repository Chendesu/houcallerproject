<?php
/**
 * 返回图片的信息
 *
 * @param string $filename 文件名
 * @return array 包含图片的宽度、高度、创建和输出的字符串以及扩展名
 */
function getImageInfo($filename){
  if(@!$info = getimagesize($filename)){
    exit('文件不是真实的图片');
  }
  $fileInfo['width'] = $info[0];
  $fileInfo['height'] = $info[1];
  $mime = image_type_to_mime_type($info[2]);
  $createFun = str_replace('/','createfrom',$mime);
  $outFun = str_replace('/','',$mime);
  $fileInfo['createFun'] = $createFun;
  $fileInfo['outFun'] = $outFun;
  $fileInfo['ext'] = strtolower(image_type_to_extension($info[2]));
  return $fileInfo;
}
/**
 * 形成缩略图的函数
 *
 * @param [type] $filename   文件名
 * @param string $dest       缩略图保存路径，默认保存在thumb目录下
 * @param string $pre        默认前缀为thumb_
 * @param [type] $dst_w      最大宽度
 * @param [type] $dst_h      最大高度
 * @param float $scale       默认缩放比例
 * @param boolean $delSource 是否删除源文件标志
 * @return void              最终保存路径及文件名
 */
function thumb($filename, $dest = 'thumb', $pre = 'thumb_', $dst_w=null, $dst_h=null, $scale=0.5, $delSource = false){
  
  $fileInfo= getImageInfo($filename);
  $src_w = $fileInfo['width'];
  $src_h = $fileInfo['height'];
  if(is_numeric($dst_w)&&is_numeric($dst_h)){
    // 如果指定最大宽度和高度，按照等比例缩放进行处理
    $ratio_orig = $src_w / $src_h;
    if($dst_w / $dst_h > $ratio_orig) {
      $dst_w = $dst_h * $ratio_orig;
    } else {
      $dst_h = $dst_w / $ratio_orig;
    }
  
  } else {
    // 没指定按照默认的缩放比例处理
    $dst_w = ceil($src_w * $scale);
    $dst_h = ceil($src_h * $scale);
  }
  $dst_image = imagecreatetruecolor($dst_w,$dst_h);
  $src_image = $fileInfo['createFun']($filename);
  // var_dump($fileInfo); exit;
  imagecopyresampled($dst_image,$src_image,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
  // 检测目标目录是否存在，不存在则创建
  if($dest && !file_exists($dest)){
    mkdir($dest, 0777, true);
  }
  $randNum = mt_rand(100000,999999);
  $dstName = "{$pre}{$randNum}".$fileInfo['ext'];
  $destination = $dest ? $dest . '/'. $dstName : $dstName;
  $fileInfo['outFun']($dst_image, $destination);
  imagedestroy($src_image);
  imagedestroy($dst_image);
  if($delSource){
    @unlink($filename);
  }
  return $destination;
}



/**
 * 文字水印
 *
 * @param [type] $filename
 * @param [type] $fontfile
 * @param string $text
 * @param string $dest
 * @param string $pre
 * @param integer $r
 * @param integer $g
 * @param integer $b
 * @param integer $alpha
 * @param integer $angle
 * @param integer $size
 * @param integer $x
 * @param integer $y
 * @return void
 */
function waterText($filename, $fontfile, $text = '慕课网', $dest = 'waterText',$pre = 'waterText', $r = 255, $g = 0, $b = 0, $alpha = 60, $angle = 0, $size = 30, $x = 0, $y = 30){
  
  $fileInfo = getImageInfo($filename);
  $image = $fileInfo['createFun']($filename);
  $color = imagecolorallocatealpha($image, $r, $g, $b, $alpha);
  imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
  if($dest && !file_exists($dest)){
    mkdir($dest, 0777, true);
  }
  $randNum = mt_rand(100000, 999999);
  $dstName = "{$pre}_{$randNum}".$fileInfo['ext'];
  $destination = $dest ? $dest.'/' . $dstName : $dstName;
  $fileInfo['outFun']($image,$destination);
  imagedestroy($image);
  return $destination;
}
/**
 * Undocumented function
 *
 * @param [type] $dstName
 * @param [type] $srcName
 * @param integer $pos
 * @param string $dest
 * @param string $pre
 * @param integer $pct
 * @param boolean $delSource
 * @return void
 */
function waterPic($dstName, $srcName, $pos = 0, $dest = 'waterPic', $pre = 'waterPic', $pct = 50, $delSource = false){
  $dstInfo = getImageInfo($dstName);
  $srcInfo = getImageInfo($srcName);
  $dst_im = $dstInfo['createFun']($dstName);
  $src_im = $srcInfo['createFun']($srcName);
  $src_width = $srcInfo['width'];
  $src_height = $srcInfo['height'];
  $dst_width = $dstInfo['width'];
  $dst_height = $dstInfo['height'];
  switch ($pos) {
    case 0:
      $x = 0;
      $y = 0;
      break;
    case 1:
      $x = ($dst_width - $src_width) / 2;
      $y = 0;
      break;
    case 2:
      $x = $dst_width - $src_width;
      $y = 0;
      break;
    case 3:
      $x = 0;
      $y = ($dst_height - $src_height) / 2;
      break;
    case 4:
      $x = ($dst_width - $src_width) / 2;
      $y = ($dst_height - $src_height) / 2;
      break;
    case 5:
      $x = $dst_width - $src_width;
      $y = ($dst_height - $src_height) / 2;
      break;
    case 6:
      $x = 0;
      $y = $dst_height - $src_height;
      break;
    case 7:
      $x = ($dst_width - $src_width)/2;
      $y = $dst_height - $src_height;
      break;
    case 8:
      $x = $dst_width - $src_width;
      $y = $dst_height - $src_height;
      break;
    default:
      $x = 0;
      $y = 0;
      break;
  }
  imagecopymerge($dst_im, $src_im, $x, $y, 0, 0, $src_width, $src_height, $pct);
  if ($dest && !file_exists($dest)) {
    mkdir($dest, 0777, true);
  }
  $randNum = mt_rand(100000, 999999);
  $dstName = "{$pre}_{$randNum}" . $dstInfo['ext'];
  $destination = $dest ? $dest . '/' . $dstName : $dstName;
  // echo $destination; exit;
  $dstInfo['outFun']($dst_im, $destination); 
  // imagepng($dst_im, $destination);
  imagedestroy($src_im);
  imagedestroy($dst_im);
  if ($delSource) {
    @unlink($dstName);
  }
  return $destination;

}


