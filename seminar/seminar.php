<?php
session_start();
require_once("../require/mysql.php");

//세미나+스케줄
if(isset($_GET['id'])){
    //sql 문구 컬럼의 이름의 한정해서 ``를 붙이며 그 외는 as로 변경한 이름등은 붙이지 않는다.
    $sql = "SELECT
        a.`id` as semi_id
        , a.`title` as semi_title
        , a.`text`
        , a.`public_datetime`
    FROM `seminar` as a
    WHERE a.`id` = {$_GET['id']}";
    // 가장 빠른 날짜 순(ASC)으로 나열하여 사용자에게 보기 편하게 한다   최근날짜순DESC
    // 세미나 이름 등에는 as를 사용하지 않아도 된다.
    if($res = $_link->query($sql)){
        //세미나를 배열
        while($row = $res->fetch_array(MYSQLI_ASSOC)){
            //배열에 넣기전에 날짜 타입을 변경한다    datetime-local한정：날짜와 시간 사이에 T가 들어감
            $row['public_datetime'] = explode(' ',$row['public_datetime']);
            //배열 []상태에 $row를 넣는다　배열은[]상태에만 무언가를 대입가능하다
            $seminar = $row;
        }
    }

    $sql = "SELECT
        b.`id` as sche_id
        , b.`seminar_id`
        , b.`title` as sche_title
        , b.`address`
        , b.`start_time`
        , b.`end_time`
        , b.`entry_fee`
    FROM `seminar_schedule` as b
    WHERE b.`seminar_id` = {$_GET['id']}
    AND   b.`status` IN (1, 2)
    ORDER BY b.`start_time` ASC";
    // 가장 빠른 날짜 순(ASC)으로 나열하여 사용자에게 보기 편하게 한다   최근날짜순DESC
    // 세미나 이름 등에는 as를 사용하지 않아도 된다.
    if($res = $_link->query($sql)){
        //세미나를 배열
        $schedule = array();
        while($row = $res->fetch_array(MYSQLI_ASSOC)){
            $row['start_time'] = substr($row['start_time'],0,16);
            $row['end_time'] = substr($row['end_time'],11,5);
            //배열 []상태에 $row를 넣는다　배열은[]상태에만 무언가를 대입가능하다
            $schedule[] = $row;
        }
    }
}
if(isset($schedule)){
    $count = count($schedule);
}

include_once("./seminar.tpl.php");
?>
