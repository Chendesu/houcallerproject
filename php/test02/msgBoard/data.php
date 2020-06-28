<?php

// $q = $_REQUEST['q'];
$q = isset($_REQUEST["q"]) ? $_REQUEST["q"]:"query";


$host = "127.0.0.1";
$username = "root";
$password = "";
$db = "db";



$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
  echo "数据库连接失败";
  exit;
}

date_default_timezone_set('PRC');//设置时区

if($q == "query"){
  queryData($conn);
  exit;
} 
if($q == "insert"){
  insertData($conn);
  
  exit;
}
if($q == "delete"){
  deleteData($conn);
  
}


  // 查询数据 && 分页
  function queryData($conn){
    
    require_once("page.class.php");
    $p = isset($_POST["p"]) ? $_POST["p"] : 1; // 当前页
    $url = "?p={p}"; // 获取当前url

    $pageSize = 10; // 每页显示记录数

    
    mysqli_query($conn, "set names 'utf8'");
    $sql = "select * from msg limit ".($p-1)*$pageSize.", {$pageSize}";
    $result = $conn->query($sql);
    $arr = array();
    
    while ($row = mysqli_fetch_array($result)) {
      $data = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'msg' => $row['msg'],
        'time' => $row['time']
      );
      array_push($arr, $data);
    }
    
    // 数据总数
    $total_sql = "select count(*) from msg";
    $total_result = mysqli_fetch_array($conn->query($total_sql));
    $total = $total_result[0];


  // $res = rsortFun($arr, "id");
  // print_r(json_encode($arr, JSON_UNESCAPED_UNICODE));
  
  
  $page = new Page();
  $page->getHtml($p, $total, $pageSize, $url);
  // $dataArr["list"] = json_encode($arr, JSON_UNESCAPED_UNICODE);
  // $dataArr["page"] = $page->getHtml($p, 100, $pageSize, $url);
  print_r($page->getHtml($p, $total, $pageSize, $url));
  
    
  }
  // 添加数据
  function insertData($conn){
    mysqli_query($conn, "set names 'utf8'");
    $name = "游客_".time();
    $time = date("Y-m-d H:i:s", time());
    $sql_insert = "insert into msg (name,msg,time) values('$name','$_POST[msg]','$time')";
    $result = $conn->query($sql_insert);
  }
  function deleteData($conn) {
    mysqli_query($conn, "set names 'utf8'");
    $sql_delete = "delete from msg where id = '$_POST[id]' ";
    $result = $conn->query($sql_delete);
  }
  
  // 关闭数据
  mysqli_close($conn);


/* 
    * 功能：针对数组的某个键的键值进行排序
    * $arr: 排序的数组;
    * $key: 键;
    */
function rsortFun($arr, $key)
{
  $arr_b = $arr; // 要排序的数组
  $arr_a = array(); // 排序数组
  $res = array(); // 存储最终结果

  foreach ($arr_b as $k => $value) {
    $arr_a[] = $value['id'];
  }
  rsort($arr_a); // 降序
  $arr_a = array_flip($arr_a); //反转数组中所有的键以及它们关联的值

  foreach ($arr_b as $k => $v) {
    $temp1 = $v[$key];
    $temp2 = $arr_a[$temp1];
    $res[$temp2] = $v;
  }
  ksort($res);
  return $res;
}







