<?php
header('content-type:text/html;charset=utf-8');
echo microtime().'<br>';
echo time(),'<br>';
echo microtime(true),'<br>';
echo '<hr>';
$start = microtime(true);
for($i=1;$i<=10000;$i++){
  $arr[] = $i;
}
$end = microtime(true);
echo '程序执行的时间：'.round($end-$start,4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="">
    <input type="date" name="" id="">
    <input type="datetime-local" name="" id="">
  </form>
</body>
</html>     