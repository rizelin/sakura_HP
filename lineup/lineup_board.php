<?php
ini_set('display_errors',1);
session_start();
require_once("../require/mysql.php");

//page
$page = isset($_GET['page'])? $_GET['page']:1;
$sql = "SELECT `id`
        FROM `lineup`
        WHERE `status` = 1
        AND `limit_datetime` > now()
        OR `limit_datetime` = '0000-00-00 00:00:00'
        ORDER BY `registration_datetime` DESC";
if ($res = $_link->query($sql)) {
    if ($res->num_rows != 0) {
        $totalData = $res->num_rows;
    }
}
$pageCount = 5;
$maxPage = ceil($totalData/$pageCount);

$startNum = ($page-1)*$pageCount;
$sql = "SELECT `id`,`name`,`caption`,`img`
        FROM `lineup`
        WHERE `status` = 1
        AND `limit_datetime` > now()
        OR `limit_datetime` = '0000-00-00 00:00:00'
        ORDER BY `registration_datetime` DESC
        LIMIT {$startNum},{$pageCount}";

if ($res = $_link->query($sql)) {
    if ($res->num_rows != 0) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $lineupList[] = $row;
        }
        $count = count($lineupList);

        //caption,name必要な形で保存
        for ($i=0; $i <$count ; $i++) {
          $lineupList[$i]['caption'] = explode("　",$lineupList[$i]['caption']);
          foreach ($lineupList[$i]['caption'] as $key => $value) {
            ($key == 0)? $lineupList[$i]['caption'][$key]="<dt>$value</dt>":$lineupList[$i]['caption'][$key]="<dd>$value</dd>" ;
          }
          $lineupList[$i]['caption'] = "<dl class='page_caption'>".implode("",$lineupList[$i]['caption'] )."</dl>";

          $lineupList[$i]['tagName'] = explode("　",$lineupList[$i]['name']);
          $nameCount = count($lineupList[$i]['tagName']);
          $tagName[$i] = $lineupList[$i]['tagName'][$nameCount-1];
        }

    } else {
       $message = "記事がありません。";
    }
}

if (isset($_SESSION['confirmMsg'])) {
    $confirmMsg = $_SESSION['confirmMsg'];
    unset($_SESSION['confirmMsg']);
}

include_once("./lineup_board.tpl.php");
?>
