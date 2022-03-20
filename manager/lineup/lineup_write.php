<?php
require_once("../require/mysql.php");
require_once("../require/login.php");
//lineup修正
if (isset($_GET['id'])) {
    $sql = "SELECT `id`,`name`,`caption`,`img`,`text`,`public_datetime`,`limit_datetime`,`registration_datetime`,`update_datetime`,`status`,`top_preview`
            FROM `lineup` WHERE `id` = {$_GET['id']}";
    if ($res = $_link->query($sql)) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
          $lineup = $row;
          $lineup['public_datetime'] = str_replace(" ","T",$lineup['public_datetime']);
          $lineup['limit_datetime'] = str_replace(" ","T",$lineup['limit_datetime']);
          $lineup['public_datetime'] = explode("T",$lineup['public_datetime']);
          $lineup['limit_datetime'] = explode("T",$lineup['limit_datetime']);
        }
    }
}
//error処理
if (isset($_SESSION['error'])) {
    $errorMsg = $_SESSION['error'];
    $lineup = $_SESSION['lineup'];
    unset($_SESSION['error'],$_SESSION['lineup']);
}
include_once("./lineup_write.tpl.php");
?>
