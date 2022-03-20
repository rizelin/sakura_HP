<?php

//DBの接続
require_once("../require/mysql.php");
//ログイン
require_once("../require/login.php");

// 이곳은 세미나의 스케줄에 대한 신청서를 쓰는 폼이다.
// 어느 세미나에 대한 스케줄 입력인지를 찾는다
if(isset($_GET['id'])){
    $sql = "SELECT
        `id`
        ,`address`
        ,`start_time`
        ,`end_time`
    FROM `seminar_schedule`
    WHERE `seminar_id` = {$_GET['id']}
    AND `status` IN (1, 2)
    ORDER BY `start_time` ASC";
    if($res = $_link->query($sql)){
        $schedule = array();
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $row['start_time'] = date('y年m月d日 h:i',strtotime($row['start_time']));
            $row['end_time'] = date('h:i',strtotime($row['end_time']));
            $schedule[] = $row;
        }
    }
    if(!empty($schedule)){
        $count = count($schedule);
    }
}

//失敗の時
if($_SESSION['errorMsgs']){
    $inquiryErrors = $_SESSION['errorMsgs']['inquiry'];
    $seminarInquiryError = $_SESSION['errorMsgs']['seminarInquiry'];
    $inquiry = $_SESSION['inquiry'];
    $seminarInquiry = $_SESSION['seminarInquiry'];
    unset($_SESSION['errorMsgs'],$_SESSION['inquiry'],$_SESSION['seminarInquiry']);
}

include_once("./seminar_inquiry_write.tpl.php");
?>
