<?php
header("content-type:text/html;charset=utf-8");
$servername = "127.0.0.1";
$username = "root";
$password = "";

$dbname = "db";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn -> connect_error) {
  die("连接失败：".$conn->connect_error);
} else {
  echo "连接成功<br>";
  $sql = "select img from user";
  $result = $conn->query($sql);
  // $row = mysqli_num_rows($result);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
      echo $row["img"];
      // $base64   = base64_encode($row["img"]);
      // $img = 'data:image/png;base64,' . $base64;
      // echo "<img style='width:100px;' src='".$img."'>";
    }
  }
}



// mysqli_query($conn, "delete from myGuests where lastname='Quagmire'");
// mysqli_close($conn);


// mysqli_query($conn, "update myGuests set age=19 where firstname='Mary'");
// mysqli_close($conn);

// $result = mysqli_query($conn, "select * from myGuests order by age DESC ");
// while($row = mysqli_fetch_array($result)){
//   echo $row['firstname'];
//   // echo " ".$row['lastname'];
//   echo " ".$row['age'];
//   echo "<br>";
// }
// mysqli_close($conn);

// $result = mysqli_query($conn, "select * from myGuests where firstname='Peter'");
// while ($row = mysqli_fetch_array($result)) {
//   echo $row['firstname']." ".$row['lastname'];
//   echo "<br>";
// }

//
// $sql = "select id, firstname, lastname from myGuests";
// $result = $conn->query($sql);
// if($result->num_rows > 0){
//   while($row=$result->fetch_assoc()){
//     echo "id:".$row["id"]."-Name:".$row["firstname"]." ".$row["lastname"]."<br>";
//   }
// } else {
//   echo "0 结果";
// }

// 预处理语句
// $stmt = $conn->prepare("insert into myGuests (firstname,lastname,email) values (?,?,?)");
// $stmt->bind_param("sss",$firstname,$lastname,$email);
// $firstname = "John233";
// $lastname = "Doe233";
// $email = "john@example.com";
// $stmt->execute();
// $firstname = "Mary233";
// $lastname = "Moe233";
// $email = "mary@example.com";
// $stmt->execute();
// $firstname = "Julie233";
// $lastname = "Dooley233";
// $email = "julie@example.com";
// $stmt->execute();
// echo "新记录插入成功";
// $stmt->close();

// 插入多条数据
// $sql = "insert into myGuests (firstname,lastname,email) values ('John','Doe','john@example.com');";
// $sql .= "insert into myGuests (firstname,lastname,email) values ('Mary','Moe','mary@example.com');";
// $sql .= "insert into myGuests (firstname,lastname,email) values ('Julie','Dooley','julie@example.com')";
// if($conn->multi_query($sql)===true){
//   echo "新记录插入成功";
// } else {
//   echo "error:".$sql."<br>".$conn->error;
// }


// 插入数据
// $sql = "insert into myGuests (firstname, lastname, email) values ('Peter','Peter','peter@example233.com')";
// if($conn->query($sql)===true){
//   echo "新记录插入成功";
// } else {
//   echo "error: ".$sql."<br>" . $conn->error;
// }

// 创建表
// $sql = "create table myGuests (
//   id int(6) unsigned auto_increment primary key,
//   firstname varchar(30) not null,
//   lastname varchar(30) not null,
//   email varchar(50),
//   reg_date timestamp
// )";

// 创建数据库
// if($conn->query($sql)===true){
//   echo "table myGuests created successfully";
// } else {
//   echo "创建数据表错误：".$conn->error;
// }
// $sql = "create database myDB";
// if($conn->query($sql)===true) {
//   echo "数据库创建成功";
// } else {
//   echo "error creating database: ".$conn->error;
// }

// 关闭数据库
// $conn->close();


// $dbname = "myDBPDO";
// try{
//   $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
//   echo "连接成功2333<br>";
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//   // 创建数据库
//   // $sql = "create database myDBPDO";
//   // $conn->exec($sql);
//   // echo "数据库创建成功<br>";

//   // 创建表
//   // $sql = "create table myGuests(
//   //   id int(6) unsigned auto_increment primary key,
//   //   firstname varchar(30) not null,
//   //   lastname varchar(30) not null,
//   //   email varchar(50),
//   //   reg_date timestamp
//   // )";
//   // $conn->exec($sql);
//   // echo "数据表myGuests创建成功";

//   // 插入数据
//   // $sql = "insert into myGuests (firstname,lastname,email) values ('John','Doe','john@example.com')";
//   // $conn->exec($sql);
//   // echo "新纪录插入成功";

//   //插入多条数据
//   // $conn->beginTransaction();
//   // $conn->exec("insert into myGuests (firstname,lastname,email) values ('John','Doe','john@example.com')");
//   // $conn->exec("insert into myGuests (firstname,lastname,email) values ('Mary','Moe','mary@example.com')");
//   // $conn->exec("insert into myGuests (firstname,lastname,email) values ('Julie','Dooley','julie@example.com')");
//   // $conn->commit();
//   // echo "新纪录插入成功";
//   // 预处理语句
//   // $stmt = $conn->prepare("insert into myGuests (firstname,lastname,email) values (:firstname,:lastname,:email)");
//   // $stmt->bindParam(':firstname',$firstname);
//   // $stmt->bindParam(':lastname',$lastname);
//   // $stmt->bindParam(':email',$email);
//   // $firstname = "John2333";
//   // $lastname = "Doe2333";
//   // $email = "john@example.com";
//   // $stmt->execute();
//   // $firstname = "Mary2333";
//   // $lastname = "Moe2333";
//   // $email = "mary@example.com";
//   // $stmt->execute();
//   // $firstname = "Julie2333";
//   // $lastname = "Dooley2333";
//   // $email = "julie@example.com";
//   // $stmt->execute();
//   // echo "新记录插入成功";



// }
// catch(PDOException $e){
//   echo $sql."<br>". $e->getMessage();
// }
// $conn=null;