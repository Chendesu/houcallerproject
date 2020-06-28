<?php
$logo = 'images/logo.jpg';
$filename = 'images/julia.jpg';
$dst_im = imagecreatefromjpeg($filename);
$src_im = imagecreatefromjpeg($logo);
imagecopymerge($dst_im, $src_im, 0, 0, 0, 0, 371, 240, 50);
header('content-type:image/jpeg');
imagejpeg($dst_im);
imagedestroy($src_im);
imagedestroy($dst_im);