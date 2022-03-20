<?php

//DBの接続
require_once("../require/mysql.php");
//ログイン
require_once("../require/login.php");

//세미나 스케줄을 신청시 실제온 인원수를 추후에 입력하기 위한 폼
if(isset($_GET['id'])){
    $sql = "SELECT `reservation_count`, `attended_count`
            FROM `seminar_inquiry`
            WHERE `id`= {$_GET['id']}";
    if($res = $_link->query($sql)){
        while($row = $res->fetch_array(MYSQLI_ASSOC)){
            $message = $row;
        }
    }
}

if(isset($_POST['id'])){
    if(is_numeric($_POST['attended_count'])){
        $attended_count = "'".$_link->real_escape_string($_POST['attended_count'])."'";
        //실제 온 인원수를 입력함
        $sql = "UPDATE `seminar_inquiry` SET `attended_count` = {$attended_count}
                WHERE `id` = '{$_POST['id']}'";
        //입력에 성공한다면
        //다시 돌아갈 위치를 찾기 위해 세미나의 id값을 찾는 sql문
        if($res = $_link->query($sql)){
            $sql = "SELECT c.`id`
                    FROM `seminar_inquiry_relation` as a
                    INNER JOIN `seminar_schedule` as b
                    ON a.`seminar_schedule_id` = b.`id`
                    INNER JOIN `seminar` as c
                    ON c.`id` = b.`seminar_id`
                    WHERE a.`seminar_inquiry_id` = {$_POST['id']}";
            if($res = $_link->query($sql)){
                while($row = $res->fetch_array(MYSQLI_ASSOC)){
                    $id = $row;
                }
                $_link->commit();
                header('location:./seminar_inquiry_management_board.php?seminar_id='.$id['id']);
                exit();
            }
        }
    } else {
        $errorMsgs = "数字のみ入力可能です";
    }

}
include_once("./seminar_inquiry_management.tpl.php");
?>
