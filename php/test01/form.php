<?php 
header("content-type:text/html;charset=utf-8");
echo "欢迎" . $_POST["fname"] . "!<br>";
echo "您的年龄是" . $_POST["age"] . "岁<br>";
// switch ( $_POST["like"]) {
//   case 'read':
//     $q = "读书";
//     break;
//   case 'draw':
//     $q = "画画";
//     break;
//   default:
//     $q = "看电视";
//     break;
// }
$size = array(
  'read'=>'阅读',
  'draw'=>'画画',
  'watchTV'=>'看电视'
);
// $q = array();
$q = null;
foreach ( $_POST["like"] as $value) {
  // array_push($q,$size[$value]);
  $q .= $size[$value];
}
// $q = serialize($q);
echo "您的爱好是" . $q."<br>";
$sex = array(
  'man'=>'男',
  'woman'=>'女'
);
echo "您的性别是".$sex[$_POST["sex"]];



