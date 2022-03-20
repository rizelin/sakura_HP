<?php
require_once("../require/mysql.php");
require_once("../require/login.php");

//持ってくるGET（title）で情報検索
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM information WHERE `id` = {$id} AND `status` In (1,2)";

  if ($res = $_link->query($sql)) {
    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
      /*配列で.위의 row변수는 일시적으로 루프안에서 사용되기 때문에
      새로운 변수에 담아 다른곳에서 사용할 수 있게 한다.*/
      $information = $row;
      //テータ値変換 0000-00-00 00:00:00 > 0000-00-00T00:00:00
      $information['public_datetime'] = str_replace(" ","T",$information['public_datetime']);
      $information['limit_datetime'] = str_replace(" ","T",$information['limit_datetime']);
      $information['public_datetime'] = explode("T",$information['public_datetime']);
      $information['limit_datetime'] = explode("T",$information['limit_datetime']);
    }
  }
}

//error処理
if (isset($_SESSION['error'])) {
    $errorMsg = $_SESSION['error'];
    $information = $_SESSION['information'];
    unset($_SESSION['error'],$_SESSION['information']);
}

include_once("./information_write.tpl.php");
?>
