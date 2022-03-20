<?php
session_start();
if(isset($_SESSION['id'])){
  $sql = "SELECT `id`,`password` FROM `manager`
          where `name`='{$_SESSION['id']}' and `password`='{$_SESSION['password']}'";
  if($res = $_link->query($sql)){
    //행수를 알아내는 태그 num_rows
    if($res->num_rows == 1){
      while($row = $res->fetch_array(MYSQLI_ASSOC)){
        $user = $row;
      }
    }
  }
}
if(!isset($user)){
  header("Location:../index.php?logout");
  exit();
}
 ?>
