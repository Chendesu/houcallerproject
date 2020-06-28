<?php
require_once 'Captcha.class.php';
$config=array(
  'fontfile'=> __DIR__. '\AllerDisplay.ttf',
  'snow'=>10
);
$captcha=new Captcha($config);
$captcha->getCaptcha();
