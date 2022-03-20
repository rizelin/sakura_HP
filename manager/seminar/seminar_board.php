<?php
// ini_set('display_errors',1); //에러를 확인하는 문구 1:에러표시 0:표시안함
//DBの接続
require_once("../require/mysql.php");
//ログイン
require_once("../require/login.php");

//전체 세미나의 수를 구한다.
//페이지 구하기
$page = isset($_GET['page'])? $_GET['page']:1;

$sql = "SELECT `id`
FROM `seminar` WHERE `status` IN (1, 2) ORDER BY `public_datetime` DESC";
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
        FROM `seminar` WHERE `status` IN (1, 2) ORDER BY `public_datetime` DESC
        LIMIT {$startNum},{$pageCount}";
if($res = $_link->query($sql)){
    if ($res->num_rows != 0) {
      while($row = $res->fetch_array(MYSQLI_ASSOC)){
        $seminarList[] = $row;
      }
    }else {
       $message = "記事がありません。";
    }
}

if (isset($_SESSION['confirmMsg'])) {
    $confirmMsg = $_SESSION['confirmMsg'];
    unset($_SESSION['confirmMsg']);
}

include_once("./seminar_board.tpl.php");
?>
