<?php
//ini_set('display_errors',1);
require_once("../require/mysql.php");
require_once("../require/login.php");

//page
$page = ($_GET['page'])? $_GET['page']:1; //클릭한 페이지의 번호
$dataCount = 10;
$sql = "SELECT a.`id`
          FROM `inquiry` as a
     LEFT JOIN `lineup_inquiry` as b
            ON a.`id` = b.`inquiry_id`
     LEFT JOIN `seminar_inquiry` as c
            ON a.`id` = c.`inquiry_id`
         WHERE b.`inquiry_id` IS NULL AND c.`inquiry_id` IS NULL
       ";
       if ($res = $_link->query($sql)) {
           if ($res->num_rows!=0) {
               $totalData = $res->num_rows;
           }
       }
$maxPage = ceil($totalData/$dataCount); //총 게시글의 페이지 수 구하기
$startNum = ($page-1)*$dataCount;

$sql = "SELECT a.`id`,a.`registration_datetime`,a.`company`,a.`name`,a.`response_datetime`
          FROM `inquiry` as a
     LEFT JOIN `lineup_inquiry` as b
            ON a.`id` = b.`inquiry_id`
     LEFT JOIN `seminar_inquiry` as c
            ON a.`id` = c.`inquiry_id`
         WHERE b.`inquiry_id` IS NULL AND c.`inquiry_id` IS NULL
      ORDER BY a.`registration_datetime` DESC
         LIMIT {$startNum},{$dataCount}
       ";
if ($res = $_link->query($sql)) {
    if ($res->num_rows!=0) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $inquiryList[] = $row;
        }
        $count = count($inquiryList);
    }
}

if (isset($_SESSION['confirmMsg'])) {
    $confirmMsg = $_SESSION['confirmMsg'];
    unset($_SESSION['confirmMsg']);
}

include_once("./inquiry_management_board.tpl.php");
?>
