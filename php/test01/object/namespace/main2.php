<?php 
namespace main2;
include "3.php";

var_dump(new \Test1());//类，这里加“\”表示在全局空间下查找，若没有“\”则在当前命名空间下查找，不存在的话会报错
Test2();//函数
echo TEST3;//常量




?>