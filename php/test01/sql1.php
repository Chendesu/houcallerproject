<?php
echo "<table style='border: 1px solid #000'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lasttname</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current(){
    return "<td style='width:150px;border:1px solid #000;'>".parent::current()."</td>";
  }
  function beginChildren(){
    echo "<tr>";
  }
  function endChildren(){
    echo "</tr>"."\n";
  }
}
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "myDBPDO";
try{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("select id, firstname, lastname from myGuests");
  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
    echo $v;
  }

} catch(PDOException $e) {
  echo "Error:" .$e->getMessage();
}
$conn = null;
echo "</table>";