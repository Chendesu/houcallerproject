<?php

/**
 * 1、创建画布
 *    $image = imagecreatetruecolor($width,$height);创建画布，返回资源，返回图像标志符
 * 2、创建颜色
 *    imagecolorallocate($image, $red, $green, $blue); 
 * 3、开始绘画
 *    imagechar();水平的绘制一个字符
 *    imagecharup();垂直绘制一个字符
 *    imagestring();水平绘制字符串
 * 4、告诉浏览器以图片的形式来显示
 *    header('content-type:image/jpeg');
 * 5、输出图像
 *    imagejpeg($image);
 * 6、销毁资源
 *    imagedestroy($image);
 */ 

$width = 300;
$height = 300;
$image = imagecreatetruecolor($width,$height);
$red = imagecolorallocate($image,255,255,0);
imagestring($image,5,50,100,'A',$red);
header('content-type:image/jpeg');
imagejpeg($image);
imagedestroy($image);
 

