<?php
require_once("../require/mysql.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];

    $sql = "SELECT `title`,`text`,`public_datetime` FROM `information` WHERE `id`={$id}";
    if ($res = $_link->query($sql)) {
      while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
        if ($res->num_rows == 1) {
            $information = $row;
        }
      }
      $information['public_datetime'] = substr($information['public_datetime'],0,10);
      $information['public_datetime'] =  $information['public_datetime'];

    }else {
      header("location:.information_board.php");
      exit();
    }

  }else {
    header("location:.information_board.php");
    exit();
}
include_once("./information.tpl.php");
?>
