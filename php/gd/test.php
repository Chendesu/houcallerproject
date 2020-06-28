<?php

$arr = array_rand(array_flip(array_merge(range('A','Z'), range('a', 'z'), range(0, 9))),6);
$str = implode('',$arr);
var_dump($str);