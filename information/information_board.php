<?
session_start();
require_once("../require/mysql.php");

//page
$page = isset($_GET['page'])? $_GET['page']:1;
$sql = "SELECT `id`
        FROM `information`
        WHERE `status` = 1
        AND `limit_datetime` > now()
        OR `limit_datetime` = '0000-00-00 00:00:00'
        ORDER BY `registration_datetime` DESC";
if ($res = $_link->query($sql)) {
    if ($res->num_rows != 0) {
        $totalData = $res->num_rows;
    }
}
$pageCount = 10;
$maxPage = ceil($totalData/$pageCount);

$startNum = ($page-1)*$pageCount;


$sql = "SELECT `id`,`title`,`public_datetime`,`limit_datetime`,now(),`status`
        FROM `information`
        WHERE `status` = 1
        AND `limit_datetime` > now()
        OR `limit_datetime` = '0000-00-00 00:00:00'
        ORDER BY `public_datetime` DESC
         LIMIT {$startNum},{$pageCount}";
 if ($res = $_link->query($sql)) {
    if ($res->num_rows!=0) {
      while($row = $res->fetch_array(MYSQLI_ASSOC)){
        $informationList[]=$row;
      }
      $count = count($informationList);
  }
for ($i=0; $i < $count; $i++) {
  $date[$i] = $informationList[$i]['public_datetime'];
  $informationList[$i]['public_datetime'] = substr($date[$i],0,10);
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
