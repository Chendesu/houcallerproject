<?php
$q = $_REQUEST["q"];
$host = "127.0.0.1";
$username = "root";
$password = "";
$db = "db";
$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
  echo "数据库连接失败！";
  exit;
}

if($q == "query"){
  queryData($conn);
}
if($q == "insert") {
  insertData($conn);
}
if($q == "delete") {
  deleteData($conn);
}

function queryData($conn){

  mysqli_query($conn, "set names 'utf8'");
  $sql = "select * from album";
  $result = $conn->query($sql);
  
  $data = array();
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      
      $base64 = base64_encode($row["picture"]);
      $img = "data:image/png;base64,".$base64;
      
      
      $arr = array(
        "id"=>$row["id"],
        "name"=>$row["name"],
        "url"=>$img
      );
      array_push($data, $arr);
  
    }
    print_r(json_encode($data, JSON_UNESCAPED_UNICODE));
  }
}

function insertData($conn){
  $form_name = $_FILES["file"]["name"];
  $form_data = $_FILES["file"]["tmp_name"];

  $data = addslashes(fread(fopen($form_data, "r"), filesize($form_data))); //二进制图片

  mysqli_query($conn, "set names 'utf8'");
  $sql_insert = "insert into album (name, picture) values('$form_name','$data')";
  $result = $conn->query($sql_insert);
  if($result) {
    echo "成功";
  } else {
    echo "失败";
  }
  
}

function deleteData($conn){
  mysqli_query($conn, "set names 'utf8'");
  $sql_delete = "delete from album where id = '$_POST[id]' ";
  
  $result = $conn->query($sql_delete);
  if ($result) {
    echo "成功";
  } else {
    echo "失败";
  }
}

