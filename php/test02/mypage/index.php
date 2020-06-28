<html>

<head>
  <style>
    a {
      display: inline-block;
      padding: 5px 10px;
      margin: 0 5px;
      color: #000;
      text-decoration: none;
      background-color: #eee;
    }

    a:link {
      color: #000;
    }

    a:hover {
      color: #9ab534;
    }

    a.sel {
      color: #fff;
      background-color: #9ab534;
    }

    form {
      display: inline;
    }

    form input {
      display: inline-block;
      width: 40px;
      margin: 0 5px;
    }
  </style>
</head>

<body>


  <?php
  header("content-type:text/html;charset=utf-8");

  /** 1、传入页码  **/
  $page = $_GET['p'];

  // 2、根据页码取出数据：php->mysql处理
  $host = "127.0.0.1";
  $username = "root";
  $password = "";
  $db = "test";

  $pageSize = 10;
  $showPage = 5;

  $conn = new mysqli($host, $username, $password, $db);

  if ($conn->connect_error) {
    die("数据连接失败");
    exit;
  }
  // 处理数据
  $sql = "select * from page limit " . ($page - 1) * $pageSize . ", {$pageSize}";
  $result = $conn->query($sql);
  echo "<table border=1 cellspacing=0 style='width:300px;height:300px;margin:0 auto;text-align:center;'>";
  echo "<tr><th>id</th><th>name</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td> {$row['id']}</td>";
    echo "<td>{$row["name"]}</td>";
    echo "</tr>";
  }
  echo "</table>";
  // 释放结果，关闭链接
  mysqli_free_result($result);
  // 获取数据总数
  $total_sql = "select count(*) from page";
  $total_result = mysqli_fetch_array($conn->query($total_sql));
  $total = $total_result[0];
  //计算页数
  $total_pages = ceil($total / $pageSize);
  mysqli_close($conn);


  /*3、显示数据 + 分页条*/
  echo "<div style='text-align:center;margin: 40px 0'>";
  $page_banner = '';
  //计算偏移量
  $pageOffset = ($showPage - 1) / 2;

  if ($page > 1) {
    $page_banner .= "<a href='" . $_SERVER['PHP_SELF'] . "?p=1'>首页</a>";
    $page_banner .= "<a href='" . $_SERVER['PHP_SELF'] . "?p=" . ($page - 1) . "'>上一页</a>";
  }

  // 初始化数据
  $start = 1;
  $end = $total_pages;
  if ($total_pages > $showPage) {
    if ($page > $pageOffset + 1) {
      $page_banner .= "...";
    }
    if ($page > $pageOffset) {
      $start = $page - $pageOffset;
      $end = $total_pages > $page + $pageOffset ? $page + $pageOffset : $total_pages;
    } else {
      $start = 1;
      $end = $total_pages > $showPage ? $showPage : $total_pages;
    }
    if ($page + $pageOffset > $total_pages) {
      $start = $start - ($page + $pageOffset - $end);
    }
  }
  for ($i = $start; $i <= $end; $i++) {
    if ($i == $page) {
      $page_banner .= "<a class='sel' href='" . $_SERVER['PHP_SELF'] . "?p=" . $i . "'>{$i}</a>";
    } else {
      $page_banner .= "<a href='" . $_SERVER['PHP_SELF'] . "?p=" . $i . "'>{$i}</a>";
    }
  }
  if ($total_pages > $showPage && $total_pages > $page + $pageOffset) {
    $page_banner .= "...";
  }

  if ($page < $total_pages) {
    $page_banner .= "<a href='" . $_SERVER['PHP_SELF'] . "?p=" . ($page + 1) . "'>下一页</a>";
    $page_banner .= "<a href='" . $_SERVER['PHP_SELF'] . "?p=" . ($total_pages) . "'>尾页</a>";
  }


  $page_banner .= "共{$total_pages}页，";
  $page_banner .= "<form action='index.php' method='get'>";
  $page_banner .= "到第<input type='number' min='1' max='" . $total_pages . "' name='p'>页";
  $page_banner .= "<input type='submit' value='确定'>";
  $page_banner .= "</form>";

  echo $page_banner;

  echo "</div>";
  ?>




</body>

</html>