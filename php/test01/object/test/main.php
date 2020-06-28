<?php

spl_autoload_register(function($className){
  require $className . ".php";
});

// function test($className){
//   require $className . ".php";
// }
// spl_autoload_register("test");

// class Momo {
//   function autoload($className) {
//     require $className . ".php";
//   }
// }
// spl_autoload_register([new Momo, 'autoload']);

$imooc = new Imooc();
var_dump($imooc);



?>