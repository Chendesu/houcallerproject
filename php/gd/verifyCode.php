<?php
$width = 200;
$height = 50;
$image = imagecreatetruecolor($width,$height);
$white = imagecolorallocate($image,255,255,255);
imagefilledrectangle($image,0,0,$width,$height,$white);
function randColor($image){

  return imagecolorallocate($image,mt_rand(0,255), mt_rand(0, 255), mt_rand(0, 255));
}
$size = mt_rand(20,28);
$angle = mt_rand(-15,15);
$x = 50;
$y = 50;
$fontFile = 'AllerDisplay.ttf';
// $text = mt_rand(1000,9999);
$text = array_rand(array_flip(array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9))), 4);
$text = implode('',$text);
for($i=0;$i<4;$i++){
  imagettftext($image, $size, $angle, $i*($width/4), mt_rand($height - 15, 45), randColor($image), $fontFile, $text[$i]);
}
// imagettftext($image,$size,$angle,$x,$y,$randColor,$fontFile,$text);
// imagesetpixel($image, mt_rand(0, $width), mt_rand(0, $height), randColor($image));
for($i=0;$i<100;$i++){
  imagesetpixel($image, mt_rand(0, $width), mt_rand(0, $height), randColor($image));
}
header('content-type:image/png');
imagepng($image);
imagedestroy($image);
