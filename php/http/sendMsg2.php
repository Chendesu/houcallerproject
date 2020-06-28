<?php 
$url = "http://localhost/http/index.php";
$postData = array(
  "title"=>"我是curl方式提交的",
  "content" => "我是curl方式提交的数据内容",
  "publish" => "发布"
);
// 初始化一个curl会话
$ch = curl_init();
// 设置相应的会话选项
// 设置提交的网址
curl_setopt($ch, CURLOPT_URL,$url);
// 设置数据提交方式
curl_setopt($ch, CURLOPT_POST,1);
// 设置数据提交方式
curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
// 提交成功后，把数据返回为字符串
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$output = curl_exec($ch);
curl_close($ch);
echo $output;

?>