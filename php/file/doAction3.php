<?php
include_once 'upload.func.php';
$fileInfo=$_FILES['myFile'];
$newName=uploadFile($fileInfo);
var_dump($newName);