<?php
header("Content-type:text/html;charset=utf-8");

function createHtmlTag($tag = ""){
  echo "<h1>$tag</h1></br>";
}

createHtmlTag("Hello");
createHtmlTag("JSON和Serialize对比");

$member = array("username","age");
var_dump($member);

$jsonObj = json_encode($member);
$serializeObj = serialize($member);
// echo $jsonObj;

createHtmlTag($jsonObj);
createHtmlTag($serializeObj);

class muke {
  public $name = "public Name";
  protected $ptName = "protected Name";
  private $pName = "private Name";

  public function getName(){
    return $this->name;
  }
}

$mukeObj = new muke();
// print_r($mukeObj);
// $objJson = json_encode($mukeObj);
// echo $objJson;






?>