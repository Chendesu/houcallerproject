<?php
class Page 
{
  public $page_cur; // 当前页
  private $total;       // 总记录数
  private $pageSize = 10;    // 每页显示记录数
  private $showPage = 5;    // 显示几个页码
  private $total_pages; // 总页数
  private $pageOffset;  // 偏移量
  private $start = 1;       // 显示的第一个页码
  private $end;         // 显示的最后一个页码

  public $host = "127.0.0.1";
  public $username = "root";
  public $password = "";
  public $db = "test";
  public $conn; // 连接数据库

  public $array = array();

  public function conn() {
    $this->page_cur = $_GET["p"];
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);
    if ($this->conn->connect_error) {
      die("数据连接失败");
      exit;
    } 
  }

  public function query()
  {
    $this->conn();
    $sql = "select * from page limit ". ($this->page_cur - 1) * $this->pageSize.", {$this->pageSize}";
    $rs = $this->conn->query($sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($rs)) {
      array_push($data, $row);
    }
    // var_dump($data);
    array_push($this->array, $data);
   
  }
  // 计算总记录数
  public function total()
  {
    $total_sql = "select count(*) from page";
    $total_result = mysqli_fetch_array($this->conn->query($total_sql));
    $this->total = $total_result[0];
    return $this->total;
  }
  // 计算页数
  public function totalPage()
  {
    $this->total_pages = ceil($this->total() / $this->pageSize);
    return $this->total_pages;
  }
  // 计算偏移量
  public function offset()
  {
    $this->pageOffset = ($this->showPage - 1) / 2;
    return $this->pageOffset;
  }

  public function outPage()
  {
    // echo "<div id='page'>";

    $page_banner = "";

    if($this->page_cur > 1){
      $page_banner .= "<a href='". $_SERVER["PHP_SELF"]."?p=1'>首页</a>";
      $page_banner .= "<a href='" . $_SERVER["PHP_SELF"] . "?p=".($this->page_cur - 1)."'>上一页</a>";
    }

    $this->end = $this->totalPage();

    if($this->totalPage() > $this->showPage){

      if($this->page_cur > $this->offset() + 1){
        $page_banner .= "...";
      }

      if($this->page_cur > $this->offset()){
        $this->start = $this->page_cur - $this->offset();
        $this->end = $this->totalPage() > $this->page_cur + $this->offset() ? $this->page_cur + $this->offset() : $this->totalPage();
      } else {
        $this->start = 1;
        $this->end = $this->totalPage() > $this->showPage ? $this->showPage : $this->totalPage();
      }

      if($this->page_cur + $this->offset() > $this->totalPage()){
        $this->start = $this->start - ($this->page_cur + $this->offset() - $this->end);
      }

    }

    for($i = $this->start; $i <= $this->end; $i++){
      if($i == $this->page_cur) {
        $page_banner .= "<a class='sel' href='".$_SERVER["PHP_SELF"]."?p=".$i."'>{$i}</a>";
      } else {
        $page_banner .= "<a href='" . $_SERVER["PHP_SELF"] . "?p=" . $i . "'>{$i}</a>";
      }
    }

    if($this->totalPage() > $this->showPage && $this->totalPage() > $this->page_cur + $this->offset()) {
      $page_banner .= "...";
    }

    if($this->page_cur < $this->totalPage()) {
      $page_banner .= "<a href='".$_SERVER["PHP_SELF"]."?p=".($this->page_cur + 1)."'>下一页</a>";
      $page_banner .= "<a href='" . $_SERVER["PHP_SELF"] . "?p=" . ($this->totalPage()) . "'>尾页</a>";
    }

    $page_banner .= "共{$this->totalPage()}页，";
    $page_banner .= "<form action='page.class.php' method='get'>";
    $page_banner .= "到第<input type='number' min='1' max='" . $this->totalPage() . "' name='p'>页";
    $page_banner .= "<input type='submit' value='确定'>";
    $page_banner .= "</form>";

    // echo $page_banner;
    // echo "</div>";

    array_push($this->array, $page_banner);

    var_dump($this->array);

  }

  

  public function __construct()
  {
    $this->query();
    
    $this->outPage();
  }


}

$page = new Page();