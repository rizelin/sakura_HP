<?php
//DBの接続
require_once("../require/mysql.php");
//ログイン
require_once("../require/login.php");


//어느 세미나의 스케줄인가 판단하고 없을시에 전체 스케줄 표시
if($_GET['seminar_id']!=0){
    $seminarSchedule = isset($_GET['seminar_id'])? "WHERE a.`id` = '{$_GET['seminar_id']}'" : '';
    $seminar_schdule = "WHERE a.`id` = {$_GET['seminar_id']}";
}
//page 정보 구하기
$page = isset($_GET['page'])?$_GET['page']:1;

$dataCount = 10;

$sql = "SELECT d.`id`
    FROM `seminar` as a
    INNER JOIN `seminar_schedule` as b
            ON a.`id` = b.`seminar_id`
    INNER JOIN `seminar_inquiry_relation` as c
            ON c.`seminar_schedule_id` = b.`id`
    INNER JOIN `seminar_inquiry` as d
            ON d.`id` = c.`seminar_inquiry_id`
    INNER JOIN `inquiry` as e
            ON e.`id` = d.`inquiry_id`
    {$seminarSchedule}";
if($res = $_link->query($sql)) {
    if ($res->num_rows!=0) {
        $totalData = $res->num_rows;
    }
}

//페이지 최대와 시작페이지 넘버
$maxPage = ceil($totalData/$dataCount);
$startNum = ($page-1)*$dataCount;

$sql = "SELECT d.`id`, b.`title`, b.`start_time`, e.`company`, e.`name`, d.`reservation_count`, d.`update_datetime`, d.`attended_count`, e.`email`, e.`tel`, e.`registration_datetime`
    FROM `seminar` as a
    INNER JOIN `seminar_schedule` as b
            ON a.`id` = b.`seminar_id`
    INNER JOIN `seminar_inquiry_relation` as c
            ON c.`seminar_schedule_id` = b.`id`
    INNER JOIN `seminar_inquiry` as d
            ON d.`id` = c.`seminar_inquiry_id`
    INNER JOIN `inquiry` as e
            ON e.`id` = d.`inquiry_id`
    {$seminar_schdule}
    GROUP BY d.`id` ORDER BY b.`start_time` ASC
    LIMIT {$startNum},{$dataCount}";

    if($res = $_link->query($sql)){
        $seminarInquiry = array();
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $seminarInquiry[] = $row;
        }
        $count = count($seminarInquiry);
    }

//セミナを選ぶ
$sql = "SELECT `id`, `title` FROM `seminar`";
if($res = $_link->query($sql)){
    $seminarArray = array();
    while($row = $res->fetch_array(MYSQLI_ASSOC)){
        $seminarArray[] = $row;
    }
    $seminarCount = count($seminarArray);
}

include_once("./seminar_inquiry_management_board.tpl.php");
?>
