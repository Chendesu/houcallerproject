<?php
header('content-type:text/html;charset=utf-8');
$filename='images/julia.jpg';
$fileInfo=getimagesize($filename);
// var_dump($fileInfo[2]); exit;
if($fileInfo){
  list($src_w,$src_h)=$fileInfo;
} else {
  die('文件不是真实的图片');
}
$src_image=imagecreatefromjpeg($filename);
$dst_image_50=imagecreatetruecolor(50,50);
$dst_image_270=imagecreatetruecolor(270,270);
imagecopyresampled($dst_image_50,$src_image,0,0,0,0,50,50,$src_w,$src_h);
imagecopyresampled($dst_image_270,$src_image,0,0,0,0,270,270,$src_w,$src_h);
imagejpeg($dst_image_50, 'images/thumb_50×50.jpg');
imagejpeg($dst_image_270, 'images/thumb_270×270.jpg');
imagedestroy($dst_image_50);
imagedestroy($dst_image_270);
imagedestroy($src_image);
