<?php
$filename='images/red.png';
if($fileInfo=getimagesize($filename)){
  list($src_w,$src_h)=$fileInfo;
  $mime=$fileInfo['mime'];
} else {
  exit('文件不是真实的图片');
}
$createFun = str_replace('/','createfrom',$mime);

// exit;
$outFun=str_replace('/',null,$mime);
// 没有比例缩放
// 设置最大宽和高
$dst_w=300;
$dst_h=600;
$ratio_orig=$src_w/$src_h;
if($dst_w/$dst_h>$ratio_orig){
  $dst_w=$dst_h*$ratio_orig;
} else {
  $dst_h=$dst_w/$ratio_orig;
}
// 创建原画布资源和目标画布资源
// $src_image=imagecreatefrompng($filename);
$src_image=$createFun($filename);
$dst_image=imagecreatetruecolor($dst_w,$dst_h);
imagecopyresampled($dst_image,$src_image,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
// imagepng($dst_image,'images/red_thumn.jpg');
$outFun($dst_image,'images/test1_thumb.jpg');
imagedestroy($src_image);
imagedestroy($dst_image);