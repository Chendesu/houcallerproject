<?php
  $postData = array(
    "title"=>"我是socket方式提交的标题",
    "content" => "我是socket方式提交的内容",
    "publish" => "发布",
  );
  $postData = http_build_query($postData);
  $fp = fsockopen("localhost",80,$errno,$errorStr,5);
  $request = "POST http://localhost/http/index.php HTTP/1.1\r\n";
  $request .= "Host:localhost\r\n";
  $request .= "Content-type:application/x-www-form-urlencoded\r\n";
  $request .= "Content-length:".strlen($postData)."\r\n\r\n";
  $request .= $postData;
  fwrite($fp, $request);
  // 读取数据
  while(!feof($fp)){
    echo fgets($fp,1024);
  };
  fclose($fp);

?>