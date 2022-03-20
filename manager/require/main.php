<?php
ini_set('display_errors',1); //에러를 확인하는 문구 1:에러표시 0:표시안함

//DBの接続
require_once("./mysql.php");
require_once("../require/login.php");

$sql = "SELECT `name`,`img` FROM `lineup` WHERE `status`= 1 AND `top_preview` ORDER BY `public_datetime` DESC";
if ($res = $_link->query($sql)) {
  while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    $lineupList[] = $row;
  }
}

//information_page
$sql = "SELECT a.`id`,a.`title`,a.`public_datetime`
                FROM `information` as a
                JOIN `manager` as b ON b.`id`=a.`manager_id`
                WHERE a.`status` IN(1,2)
                ORDER BY a.`public_datetime` DESC
                LIMIT 0,5";
if($res = $_link->query($sql)){
    if($res->num_rows!=0){
        while($row = $res->fetch_array(MYSQLI_ASSOC)){
            $row['public_datetime'] = substr($row['public_datetime'],0,11);
            $information_list[] = $row;
        }
    }
} else {
    $message = "記事がありません";
}

//seminar_schedule_page
$sql = "SELECT `id`,`seminar_id`,`title`,`address`,`start_time`,`end_time`
        FROM `seminar_schedule`
        WHERE `status` IN(1,2)
        ORDER BY `start_time` DESC
        LIMIT 0,5";
if($res = $_link->query($sql)){
    if($res->num_rows!=0){
        while($row = $res->fetch_array(MYSQLI_ASSOC)){
            $row['start_time'] = substr($row['start_time'],0,16);
            $row['end_time'] = substr($row['end_time'],11,5);
            $schedule_list[] = $row;
        }
    }
}

include_once("./main.tpl.php");
?>
