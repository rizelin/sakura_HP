<?php
session_start();
require_once("../require/mysql.php");

//전체 세미나의 수를 구한다.
//페이지 구하기
$page = isset($_GET['page'])? $_GET['page']:1;

$sql = "SELECT `id`
        FROM `seminar`
        WHERE `status` = 1
        AND `limit_datetime` > now()
        OR `limit_datetime` = '0000-00-00 00:00:00'
        ORDER BY `public_datetime` DESC";
if($res = $_link->query($sql)){
    if($res->num_rows != 0){
        $totalData = $res->num_rows;
    }
}
//한 페이지당 최대 세미나 표시 수
$pageCount = 5;
//전체 페이지 구하기  select로 구한 값/세미나 최대 표시수
$maxPage = ceil($totalData/$pageCount);
//번호는 눌렀을 때 시작 페이지(기본은 1)
$startNum = ($page-1)*$pageCount;

//세미나 리스트를 불러온다
$sql = "SELECT `id`, `title`, `caption`, `img`
        FROM `seminar`
        WHERE `status` = 1
        AND `limit_datetime` > now()
        OR `limit_datetime` = '0000-00-00 00:00:00'
        ORDER BY `public_datetime` DESC
        LIMIT {$startNum},{$pageCount}";
if($res = $_link->query($sql)){
    while($row = $res->fetch_array(MYSQLI_ASSOC)){
        $seminarList[] = $row;
    }
}

include_once("./seminar_board.tpl.php");
?>
