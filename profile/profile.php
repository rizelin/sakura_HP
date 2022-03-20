<?php
ini_set('display.errors',1); //에러를 확인하는 문구 1:에러표시 0:표시안함

require_once("../require/mysql.php");



/*選択した記事*/
    $sql = "SELECT `id` FROM `fixed_page` WHERE `profile_status` = '1'";
    if ($res = $_link->query($sql)) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $profile = "WHERE `id` = {$row['id']}";
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

  include_once("./profile.tpl.php");
?>
