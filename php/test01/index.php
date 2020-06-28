<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body>
  <!-- <form method="post" action="./form.php">
    <div>
      <label for="fname">姓名:</label>
      <input type="text" id="fname" name="fname">
    </div>
    <div>
      <label for="age">年龄:</label>
      <input type="text" id="age" name="age">
    </div>
    <div>
      <label for="like">爱好:</label>
      <select name="like[]" multiple="multiple" id="like">
        <option value="read">阅读</option>
        <option value="draw">画画</option>
        <option value="watchTV">看电视</option>
      </select>
    </div>
    <div>
      <label for="like">爱好:</label>
      <input type="checkbox" name="like[]" value="read">阅读
      <input type="checkbox" name="like[]" value="draw">画画
      <input type="checkbox" name="like[]" value="watchTV">看电视
    </div>
    <div>
      <label for="sex">性别:</label>
      <input type="radio" id="sex" name="sex" value="man"> 男
      <input type="radio" id="sex" name="sex" value="woman"> 女
    </div>
    <input type="submit" value="提交">
  </form> -->
  <?php 
    echo phpinfo();
  ?>
  <?php include 'menu.php' ?>
  <?php
  $nameErr = $emailErr = $genderErr = $websiteErr = "";
  $name = $email = $gender = $comment = $website = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "名字是必须的";
    } else {
      $name = test_input($_POST["name"]);
      if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "只允许字母和空格";
      }
    }

    if (empty($_POST["email"])) {
      $emailErr = "邮箱是必须的";
    } else {
      $email = test_input($_POST["email"]);
      if (!preg_match("/([\w\-]+\@[\w\-]+.[\w\-]+)/", $email)) {
        $emailErr = "非法邮箱格式";
      }
    }

    if (empty($_POST["website"])) {
      $website = "";
    } else {
      $website = test_input($_POST["website"]);
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=`_|!;,.:]*[-a-z0-9+&@#\/%=`_|]/i", $website)) {
        $websiteErr = "非法的URL地址";
      }
    }

    if (empty($_POST["comment"])) {
      $comment = "";
    } else {
      $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["gender"])) {
      $genderErr = "性别是必须的";
    } else {
      $gender = test_input($_POST["gender"]);
    }
  }
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
    <div>
      名字：<input type="text" name="name" value="<?php echo $name; ?>">
      <span class="error">* <?php echo $nameErr ?></span>
    </div>
    <div>
      email：<input type="text" name="email" value="<?php echo $email; ?>">
      <span class="error">* <?php echo $emailErr ?></span>
    </div>
    <div>
      网址：<input type="text" name="website" value="<?php echo $website; ?>">
      <span class="error"><?php echo $websiteErr ?></span>
    </div>
    <div>
      备注：<textarea name="comment" id="" cols="30" rows="5"><?php echo $comment ?></textarea>
    </div>
    <div>
      性别：
      <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female"> 女
      <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male"> 男
      <span class="error">*<?php echo $genderErr ?></span>
    </div>
    <input type="submit" name="submit" value="Submit">
  </form>
  <?php
  echo "<h2>您输入的内容是：</h2>";
  echo $name;
  echo "<br>";
  echo $email;
  echo "<br>";
  echo $website;
  echo "<br>";
  echo $comment;
  echo "<br>";
  echo $gender;

  ?>
</body>

</html>