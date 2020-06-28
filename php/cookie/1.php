<?php
// setcookie('a', 'aaa', time() + 10);
// setcookie('b', 'bbb', time() + 15);
// setcookie('c', 'ccc', time() + 20);

// header('Set-Cookie: a=1');
// header('Set-Cookie: b=2;expires='.gmdate('D, d M Y H:i:s \G\M\T',time()+3600));


// cookie保存数组形式的数据
setcookie('userInfo[username]','king',strtotime('+7 days'));
setcookie('userInfo[email]', 'muke@imooc.com', strtotime('+7 days'));
setcookie('userInfo[addr]', 'beijing', strtotime('+7 days'));




?>