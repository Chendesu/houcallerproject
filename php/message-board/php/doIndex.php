<?php
header('content-type:text/html;charset=utf-8;');

session_start();


  $content= $_POST['content']; // 内容
  $username= $_SESSION['username']; //用户
  
  date_default_timezone_set('PRC'); 
  $time= date('Y-m-d H:i:s'); // 时间
  
  $fileInfo = $_FILES['myFile'];
  // var_dump($fileInfo); exit;

  if(empty($content)){
    exit("<script>
      alert('内容不为空');
      location.href='../index.php';
    </script>");
  }
  
  $maxSize= 5242880;
  $allowExt=array('jpeg','jpg','png','gif');
  if($fileInfo['error']>0){
    switch($fileInfo['error']) {
      case 1:
      case 2:
        exit("<script>
          alert('超过限制的大小');
          location.href='../index.php';
        </script>");
        break;
      case 3:
        exit("<script>
          alert('文件部分被上传');
          location.href='../index.php';
        </script>");
        break;
      // case 4:
      //   exit("<script>
      //     alert('请选择要上传的文件');
      //     location.href='index.php';
      //   </script>");
      //   break;
      case 6:
        exit("<script>
          alert('找不到目录');
          location.href='../index.php';
        </script>");
        break;
      case 7:
      case 8:
        exit("<script>
          alert('系统错误');
          location.href='../index.php';
        </script>");
        break;
    }
  } else {
  
    if($fileInfo['size']> $maxSize){
      // exit("上传文件过大");
      exit("<script>
          alert('上传文件过大');
          location.href='../index.php';
        </script>");
    }
  
    $ext=pathinfo($fileInfo['name'], PATHINFO_EXTENSION);
    if(!in_array($ext, $allowExt)){
      // exit("非法文件类型");
      exit("<script>
          alert('非法文件类型');
          location.href='../index.php';
        </script>");
    }
  
    if(!is_uploaded_file($fileInfo['tmp_name'])){
      // exit("文件不是通过post http 方式上传的");
      exit("<script>
          alert('文件不是通过post http 方式上传的');
          location.href='../index.php';
        </script>");
    }

    if($fileInfo['error']!==4){
      $path='../uploads';
      if(!file_exists($path)){
        mkdir($path,0777,true);
        chmod($path,0777);
      }
      // $uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
      $uniName = uniqid('blog_'.time()).'.'.$ext;
      // echo $uniName; exit;

      $destination= $path.'/'.$uniName;  // 图片存储路径
      if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
        exit("<script>
            alert('文件上传失败');
            location.href='../index.php';
          </script>");
      }
      $url = 'http://localhost/message-board/' . substr($destination, 3);
      
    } else {
      $url = '';
    }
  } 
  
  
  
  $conn = new mysqli('127.0.0.1','root','','test');
  if($conn->connect_error){
    exit("<script>
      alert('数据库连接失败');
      location.href='../index.php';
    </script>");
  }
  mysqli_query($conn, "set names 'utf8'");
  $sql_insert="insert into message (username,time,text,image) values ('$username','$time','$content','$url') ";
  $result=$conn->query($sql_insert);
  if($result){
    exit("<script>
      alert('发表成功');
      location.href='../index.php';
    </script>");
  }else {
    exit("<script>
      alert('发表失败，请稍后重试');
      location.href='../index.php';
    </script>");
  }

mysqli_close($conn);






