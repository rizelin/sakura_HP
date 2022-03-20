<?
session_start();
require_once("../require/mysql.php");

//page
$page = isset($_GET['page'])? $_GET['page']:1;
$sql = "SELECT a.`id` FROM `information` as a
          JOIN `manager` as b ON b.`id`= a.`manager_id`
         WHERE a.`status` IN (1,2)";
if ($res = $_link->query($sql)) {
    if ($res->num_rows != 0) {
        $totalData = $res->num_rows;
    }
}
$pageCount = 10;
$maxPage = ceil($totalData/$pageCount);
$startNum = ($page-1)*$pageCount;

$sql = "SELECT b.`name`,a.`id`,a.`title`,a.`registration_datetime`,a.`public_datetime`,a.`status`
          FROM `information` as a
		      JOIN `manager` as b ON b.`id`= a.`manager_id`
         WHERE a.`status` IN(1,2)
      ORDER BY a.`public_datetime` DESC
         LIMIT {$startNum},{$pageCount}";
 if ($res = $_link->query($sql)) {
    if ($res->num_rows!=0) {
      while($row = $res->fetch_array(MYSQLI_ASSOC)){
            if ($row['status']==1) {
               $row['status'] = "公開";
            }else {
               $row['status'] = "非公開";
            }
        $informationList[]=$row;
      }
  }
 }else {
    $message = "記事がありません。";
}

if (isset($_SESSION['confirmMsg'])) {
    $confirmMsg = $_SESSION['confirmMsg'];
    unset($_SESSION['confirmMsg']);
}

include_once("./information_board.tpl.php");
?>
