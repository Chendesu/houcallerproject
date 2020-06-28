<?php
$filename = $_FILES['myFile']['name'];
$type = $_FILES['myFile']['type'];
$tmp_name = $_FILES['myFile']['tmp_name'];
$size = $_FILES['myFile']['size'];
$error = $_FILES['myFile']['error'];
var_dump($_FILES['myFile']); exit;
move_uploaded_file($tmp_name, "uploads/".$filename);
// copy($tmp_name,"uploads/".$filename);