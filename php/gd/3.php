<?php
$image = imagecreatetruecolor(500,500);
$white = imagecolorallocate($image,255,255,255);
$randColor = imagecolorallocate($image,mt_rand(0,255), mt_rand(0, 255), mt_rand(0, 255));
imagefilledrectangle($image,0,0,500,500,$white);
imagettftext($image,20,0,100,100,$randColor, __DIR__. '\msyh.ttc','呵呵');
header('content-type:image/png');
imagepng($image);
// imagepng($image,'images/1.png');
imagedestroy($image);