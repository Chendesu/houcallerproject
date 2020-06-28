<?php
/*file_get_contents和fopen构造表单提交*/


$postData = array(
  "title"=> "我是fopen构造的数据",
  "content"=> "我是fopen构造的数据类容",
  "publish"=>"发布"
);

$postData = http_build_query($postData);

$opts = array(
  "http"=>array(
    "method"=>"POST",
    "header"=>"Host:localhost\r\n".
              "Content-type:application/x-www-form-urlencoded\r\n".
              "Content-length:".strlen($postData)."\r\n",
    "content"=>$postData,
  )
);


$content = stream_context_create($opts);
// file_get_contents("http://localhost/http/index.php",false,$content);
$fp = fopen("http://localhost/http/index.php","r",false,$content);
fclose($fp);




?>