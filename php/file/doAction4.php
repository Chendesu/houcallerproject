<?php
header('content-type:text/html;charset=utf-8');
// include_once 'upload.func1.php';
// $files=getFiles();
// // print_r($files);   exit;
// foreach($files as $fileInfo) {
//   $res=uploadFile($fileInfo);
//   echo $res['mes'],'<br />';
//   $uploadFiles[]=$res['dest'];
// }
// $uploadFiles = array_values(array_filter($uploadFiles));
// print_r($uploadFiles);


require_once 'upload.class.php';
$upload=new upload('myFile');
$dest=$upload->uploadFile();
echo $dest; 

