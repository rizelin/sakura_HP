<?php
require_once("../require/mysql.php");
require_once("../require/login.php");

//Paging
$page = ($_GET['page'])? $_GET['page']:1;
$dataCount = 10;
$sql = "SELECT a.`id`
          FROM `lineup_inquiry` as a
    INNER JOIN `lineup_inquiry_relation` as b
            ON  a.`id` = b.`lineup_inquiry_id`
    RIGHT JOIN `inquiry` as c
            ON  a.`inquiry_id` = c.`id`
    INNER JOIN `lineup` as d
            ON  b.`lineup_id` = d.`id`
      GROUP BY  a.`id`
      ORDER BY  c.`registration_datetime` DESC";
        if ($res = $_link->query($sql)) {
          if ($res->num_rows!=0) {
            $totalData = $res->num_rows;
          }
        }

$maxPage = ceil($totalData/$dataCount);
$startNum = ($page-1)*$dataCount;
$sql = "SELECT a.`id`, c.`id` as inquiry_id, c.`registration_datetime`,GROUP_CONCAT(d.`name` SEPARATOR ',')as lineup_name, c.`company`, c.`name`, c.`response_datetime`
          FROM `lineup_inquiry` as a
    INNER JOIN `lineup_inquiry_relation` as b
            ON  a.`id` = b.`lineup_inquiry_id`
    RIGHT JOIN `inquiry` as c
            ON  a.`inquiry_id` = c.`id`
    INNER JOIN `lineup` as d
            ON  b.`lineup_id` = d.`id`
      GROUP BY  a.`id`
      ORDER BY  c.`registration_datetime` DESC
         LIMIT {$startNum},{$dataCount}";

        if ($res = $_link->query($sql)) {
          if ($res->num_rows!=0) {
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                $lineupInquiryList[] = $row;
            }
            $count = count($lineupInquiryList);
          }
        }

    if (!empty($_SESSION['confirmMsg'])) {
        $confirmMsg = $_SESSION['confirmMsg'];
        unset($_SESSION['confirmMsg']);
    }

    include_once("./lineup_inquiry_management_board.tpl.php");
 ?>
