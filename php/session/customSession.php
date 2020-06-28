<?php
class CustomSession implements SessionHandlerInterface{
  private $link;
  private $maxlifetime;
  public function open($savePath,$session_name)
  {
    $this->maxlifetime = get_cfg_var('session.gc_maxlifetime');
    $this->link = mysqli_connect('localhost','root','');
    mysqli_set_charset($this->link, 'utf8');
    mysqli_select_db($this->link,'test');
    if($this->link){
      return true;
    }
    return false;
  }
  public function close()
  {
    mysqli_close($this->link);
    return true;
  }
  public function read($session_id)
  { 
    $id = mysqli_escape_string($this->link,$session_id);
    $sql = "select * from sessions where session_id = '{$session_id}' and session_expires>".time();
    $result = $this->link->query($sql);
    $num = mysqli_num_rows($result);
    if($num==1){
      return mysqli_fetch_assoc($result)['session_data'];
    } else {
      return "";
    }
  }
  public function write($session_id,$session_data)
  {
    $newExp = time() + $this->maxlifetime;
    $session_id = mysqli_escape_string($this->link,$session_id);
    // 首先查询是否存在指定的session_id，如果存在相当于更新数据，否则是第一次，则自恶如数据
    $sql = "select * from sessions where session_id='{$session_id}'";
    // $result = mysqli_query($this->link,$sql);
    $result = $this->link->query($sql);
    $num = mysqli_num_rows($result);
    if($num==1){
      $sql = "update sessions set session_expire ='{$newExp}', session_data='{$session_data}' where session_id='{$session_id}'" ;
      
    } else {
      $sql = "insert sessions values('{$session_id}','$session_data','{$newExp}')";

    }
    mysqli_query($this->link, $sql);
    return mysqli_affected_rows($this->link)==1;
  }
  public function destroy($session_id)
  { 
    $session_id = mysqli_escape_string($this->link,$session_id);
    $sql = "delete from sessions where session_id = '{$session_id}' ";
    mysqli_query($this->link,$sql);
    return mysqli_affected_rows($this->link)==1;
  }
  public function gc($maxlifetime)
  { 
    $sql = "delete from sessions where session_expires<".time();
    mysqli_query($this->link,$sql);
    if(mysqli_affected_rows($this->link)>0){
      return true;
    } else {
      return false;
    }
  }

}