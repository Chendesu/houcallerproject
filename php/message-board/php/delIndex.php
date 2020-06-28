<?php
// echo $_POST['id'];

  $id=$_POST['id'];
  $conn=new mysqli('127.0.0.1','root','','test');
  if($conn->connect_error){
    // exit("<script>
    //   alert('数据库连接失败');
    //   location.href='index.php';
    // </script>");
    $arr=array(
      'no'=> 0,
      'status'=>'数据库连接失败'
    );
    print_r(json_encode($arr, JSON_UNESCAPED_UNICODE));
    exit;
  }
  
  $sql_del="delete from message where id='{$id}'";
  $res_del = $conn->query($sql_del);
  if($res_del){
  // exit("<script>
  //   alert('删除成功');
  //   location.href='index.php';
  // </script>");
  $arr = array(
    'no'=> 1,
    'status' => '删除成功'
  );
  print_r(json_encode($arr, JSON_UNESCAPED_UNICODE));
  exit;
  } else {
  // exit("<script>
  //   alert('系统繁忙');
  //   location.href='index.php';
  // </script>");
  $arr = array(
    'no'=> -1,
    'status' => '系统繁忙'
  );
  print_r(json_encode($arr, JSON_UNESCAPED_UNICODE));
  exit;
  }
  mysqli_close($conn);
  

// 

