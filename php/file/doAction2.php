<?php
header('content-type:text/html;charset=utf-8');
$fileInfo=$_FILES['myFile'];
$maxSize=2097152;
$allowExt=array('jpeg','jpg','png','gif','wbmp');
$flag=true;// 是否检测为真实的图片类型
// 1、判断错误号
if($fileInfo['error']==0){
  // 判断上传文件的大小
  if($fileInfo['size']>$maxSize){
    exit('上传文件过大');
  }
  
  $ext=pathinfo($fileInfo['name'], PATHINFO_EXTENSION);
  // echo $ext; exit;
  if(!in_array($ext,$allowExt)){
    exit('非法文件类型');
  }
  // 判断文件是否通过HTTP POST方式上传来的
  if(is_uploaded_file($fileInfo['tmp_name'])){
    exit('文件不是通过HTTP POST方式上传的');
  }
  // 检测是否为真实的图片类型
  if($flag){
    if(!getimagesize($fileInfo['tmp_name'])){
      exit('不是真正的图片类型');
    }
  }
  $path='uploads';
  if(!file_exists($path)){
    mkdir($path,0777,true);
    chmod($path,0777);
  }
  // 确保文件名唯一，防止重名产生覆盖
  $uniName=md5(uniqid(microtime(true),true)).'.$ext';
  $destination=$path.'/'. $uniName;
  if(move_uploaded_file($fileInfo['tmp_name'],$destination)){
    echo '文件上传成功';
  } else {
    echo '文件上传失败';
  }

} else {
  // 匹配错误信息
  switch ($fileInfo['error']) {
    case 1:
      echo '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
      break;
    case 2:
      echo '超过了表单MAX_FILE_SIZE限制的大小';
      break;
    case 3:
      echo '文件部分被上传';
      break;
    case 4:
      echo '没有选择上传文件';
      break;
    case 6:
      echo '没有找到临时目录';
      break;
    case 7:
    case 8:
      echo '系统错误';
      break;
  }
}
