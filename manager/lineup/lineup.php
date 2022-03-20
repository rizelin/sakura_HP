<?
require_once("../require/mysql.php");

if (isset($_GET['id'])) {
    $sql = "SELECT `id`,`name`,`caption`,`img`,`text`,`public_datetime`,`limit_datetime`,`status`
            FROM lineup WHERE `id` = {$_GET['id']}";
    if ($res = $_link->query($sql)) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
          $lineup = $row;
          $lineup['public_datetime'] = str_replace(" ","T",$lineup['public_datetime']);
          $lineup['limit_datetime'] = str_replace(" ","T",$lineup['limit_datetime']);
        }
    }
}else {
  header("location:./lineup_board.php");
  exit();
}
include_once("./lineup.tpl.php");
?>
