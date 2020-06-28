<?php
$filename = 'images/red.png';
$fileInfo = getimagesize($filename);
$mime = $fileInfo['mime'];
$createFun = str_replace('/', 'createfrom', $mime);
$outFun = str_replace('/',null, $mime);
$image = $createFun($filename);
// $red = imagecolorallocate($image, 255, 0, 0);
$red = imagecolorallocatealpha($image, 255,255,0, 80);
$fontfile = __DIR__ . '\AllerDisplay.ttf';
imagettftext($image,40,0,500,800,$red,$fontfile,'weiwuxian');
header('content-type:'.$mime);
$outFun($image);
imagedestroy($image);

