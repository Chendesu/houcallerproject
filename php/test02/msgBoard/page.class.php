<?php
  /*
* 功能： 分页
* 参数:  $page_cur - 当前页
*        $url - 获取当前的url
*        $total - 总记录数
*        $pageSize 每页显示记录数
*/
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
    private $url;  //获取当前的url

    // 计算页数
    public function totalPage($total, $pageSize)
    {
      $this->total = $total;
      $this->$pageSize = $pageSize;
      $this->total_pages = ceil($this->total / $this->pageSize);
      return $this->total_pages;
    }
    // 计算偏移量
    public function offset()
    {
      $this->pageOffset = ($this->showPage - 1) / 2;
      return $this->pageOffset;
    }

    public function page_replace($p) 
    {
      return str_replace("{p}", $p, $this->url);
    }

    public function getHtml($page_cur = 1, $total = 1, $pageSize = 10, $url)
    {
      $this->page_cur = $page_cur;
      $this->total = $total;
      $this->pageSize = $pageSize;
      $this->url = $url;

      $page_banner = "<div id='page'>";
      

      if ($this->page_cur > 1) {
        $page_banner .= "<a href='" . $this->page_replace(1) . "'>首页</a>";
        $page_banner .= "<a href='" . $this->page_replace($this->page_cur - 1) . "'>上一页</a>";
      }

      $this->end = $this->totalPage($this->total, $this->pageSize);
      if ($this->totalPage($this->total, $this->pageSize) > $this->showPage) {

        if ($this->page_cur > $this->offset() + 1) {
          $page_banner .= "...";
        }

        if ($this->page_cur > $this->offset()) {
          $this->start = $this->page_cur - $this->offset();
          $this->end = $this->totalPage($this->total, $this->pageSize) > $this->page_cur + $this->offset() ? $this->page_cur + $this->offset() : $this->totalPage($this->total, $this->pageSize);
        } else {
          $this->start = 1;
          $this->end = $this->totalPage($this->total, $this->pageSize) > $this->showPage ? $this->showPage : $this->totalPage($this->total, $this->pageSize);
        }

        if ($this->page_cur + $this->offset() > $this->totalPage($this->total, $this->pageSize)) {
          $this->start = $this->start - ($this->page_cur + $this->offset() - $this->end);
        }
      }

      for ($i = $this->start; $i <= $this->end; $i++) {
        if ($i == $this->page_cur) {
          $page_banner .= "<a class='sel' href='" . $this->page_replace($i) . "'>{$i}</a>";
        } else {
          $page_banner .= "<a href='" . $this->page_replace($i) . "'>{$i}</a>";
        }
      }

      if ($this->totalPage($this->total, $this->pageSize) > $this->showPage && $this->totalPage($this->total, $this->pageSize) > $this->page_cur + $this->offset()) {
        $page_banner .= "...";
      }

      if ($this->page_cur < $this->totalPage($this->total, $this->pageSize)) {
        $page_banner .= "<a href='" . $this->page_replace($this->page_cur + 1) . "'>下一页</a>";
        $page_banner .= "<a href='" . $this->page_replace($this->totalPage($this->total, $this->pageSize)) . "'>尾页</a>";
      }

      $page_banner .= "共{$this->totalPage($this->total,$this->pageSize)}页";
      // $page_banner .= "<form action='". $_SERVER["PHP_SELF"]."' method='get'>";
      // $page_banner .= "到第<input type='number' min='1' max='" . $this->totalPage($this->total, $this->pageSize) . "' name='p'>页";
      // $page_banner .= "<input type='submit' value='确定'>";
      // $page_banner .= "</form>";

      
      $page_banner .= "</div>";
      return $page_banner;

    }

  }

// $p = isset($_GET["p"]) ? $_GET["p"] : 1; // 当前页
// $url = $_SERVER["PHP_SELF"]."?p={p}"; // 获取当前url
// $pageSize = 10; // 每页显示记录数
// $page = new Page();

// print_r($page->getHtml($p, 100, $pageSize, $url));

  
  ?>
