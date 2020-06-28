<?php
$filename= 'images/watermelon.jpg';
$fileInfo=getimagesize($filename);
// print_r($fileInfo); exit;
list($src_w,$src_h)=$fileInfo;
// 创建100*100
$dst_w=480;
$dst_h=270;
// 创建目标画布资源
$dst_image=imagecreatetruecolor($dst_w,$dst_h);
// 通过图片文件创建你画布资源
$src_image=imagecreatefromjpeg($filename);
imagecopyresampled($dst_image,$src_image,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
imagejpeg($dst_image, 'images/thumb_watermelon.jpg');
imagedestroy($src_image);
imagedestroy($dst_image);


