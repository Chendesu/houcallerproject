<?php
header("content-type: text/html;charset=utf-8");
session_start();
date_default_timezone_set("PRC");


$act = $_GET["act"];

$conn = new mysqli("127.0.0.1", "root", "", "test");
if ($conn->connect_error) {
  exit("<script>
    alert('数据库连接失败');
    location.href = '../album.php';
  </script>");
}
mysqli_query($conn, "set names 'utf8'");


if($act == "add") {
  $username = $_SESSION["username"];
  $text = $_POST["albumTxt"];
  $time = date("Y-m-d H:i:s");
  
  $fileInfo = $_FILES["myFile"];
  $maxSize = 5242880;
  $allowExt = array("jpeg","jpg","png","gif");
  if($fileInfo["error"] > 0){
    switch($fileInfo["error"]){
      case 1:
      case 2:
        exit("<script>
          alert('图片超过限制大小');
          location.href = '../album.php';
        </script>");
        break;
      case 3:
        exit("<script>
          alert('文件部分被上传');
          location.href = '../album.php';
        </script>");
        break;
      case 6: 
        exit("<script>
          alert('找不到目录');
        </script>");
        break;
      case 7:
      case 8:
        exit("<script>
          alert('系统错误');
          location.href = '../album.php';
        </script>");
        break;
    }
  } else {
    if($fileInfo["size"] > $maxSize){
      exit("<script>
        alert('图片超过限制大小');
        location.href = '../album.php';
      </script>");
    }
  
    $ext = pathinfo($fileInfo["name"], PATHINFO_EXTENSION);
    if(!in_array($ext, $allowExt)){
      exit("<script>
        alert('非法文件类型');
        location.href = '../album.php';
      <script>");
    }
  
    if($fileInfo["error"]!==4){
      $path = "../album";
      if(!file_exists($path)){
        mkdir($path, 0777, true);
        chmod($path, 0777);
      }
      $uniName = uniqid("blog_".time()).".".$ext;
      $destination = $path."/".$uniName;
      if(!move_uploaded_file($fileInfo["tmp_name"], $destination)){
        exit("<script>
          alert('文件上传失败');
          location.href = '../album.php';
        </script>");
      }
      $url = "http://localhost/message-board/".substr($destination, 3);
    } else {
      $url = "";
    }
  }
  
  $sql_insert = "INSERT INTO album (username, time, text, images) values ('$username','$time','$text','$url')";
  $result_insert = $conn->query($sql_insert);
  if($result_insert){
    exit("<script>
      alert('提交成功');
      location.href = '../album.php';
    </script>");
  } else {
    exit("<script>
      alert('提交失败，请稍后重试');
      location.href = '../album.php';
    </script>");
  }
} 
if($act == "query") {
  $sql = "SELECT * FROM album order by id desc";
  $result = $conn->query($sql);
  $arr = array();
  while($row = mysqli_fetch_array($result)){
    $array = array(
      "id"=>$row["id"],
      "username"=>$row["username"],
      "time"=>$row["time"],
      "text"=>$row["text"],
      "url"=>$row["images"]
    );
    array_push($arr, $array);
  }
  print_r(json_encode($arr, JSON_UNESCAPED_UNICODE));
}


mysqli_close($conn);
