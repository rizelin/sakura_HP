<?php
ini_set('display.errors',1); //에러를 확인하는 문구 1:에러표시 0:표시안함

require_once("../require/mysql.php");
require_once("../require/login.php");


//すべての記事select
$sql = "SELECT `id`,`title` FROM `fixed_page` WHERE `status`= 1";
if ($res = $_link->query($sql)) {
  while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    $fixedArray[] = $row;
  }
}
$count = count($fixedArray);

/*選択した記事*/
if (isset($_GET['profile_id'])) {
  $fixedId = $_GET['profile_id'];
  $profile = "WHERE `id`={$fixedId}";
  $sql = "UPDATE `fixed_page` SET `profile_status` = 0 WHERE `profile_status` = 1";
  if ($res = $_link->query($sql)) {
      $sql = "UPDATE `fixed_page` SET `profile_status` = 1 WHERE `id` = '{$fixedId}'";
      if ($res = $_link->query($sql)) {
          $_link->commit();
      }
  }
} else {
    $sql = "SELECT `id` FROM `fixed_page` WHERE `profile_status` = '1'";
    if ($res = $_link->query($sql)) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $profile = "WHERE `id` = {$row['id']}";
        }
    }
}

$sql = "SELECT `id`,`text`
        FROM `fixed_page`
        {$profile}";
  if ($res = $_link->query($sql)) {
    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
      $fixed = $row;
    }
  }


if (isset($_SESSION['confirmMsg'])) {
    $confirmMsg = $_SESSION['confirmMsg'];
    unset($_SESSION['confirmMsg']);
}
  include_once("./profile.tpl.php");
?>
