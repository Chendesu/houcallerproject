<?php
include "1.php";
include "2.php";

// 导入类
use venter\session\Imooc;
use venter\Imooc as Imooc2;

// 导入函数
use function venter\iLikeImooc;

// 导入常量
use const venter\IMOOC;




/*  调用   */
// 类
// var_dump(new venter\Imooc());
// var_dump(new venter\session\Imooc);

// 函数
// venter\iLikeImooc();


// 常量
// echo venter\IMOOC;


// 使用use
// 类
// var_dump(new Imooc);
// var_dump(new Imooc2);
// 函数
iLikeImooc();
// 常量
var_dump(IMOOC);
