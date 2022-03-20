<?
require_once("../require/mysql.php");

if (isset($_GET['id'])) {
    $sql = "SELECT `name`,`text`,`public_datetime`
            FROM lineup WHERE `id` = {$_GET['id']}";
    if ($res = $_link->query($sql)) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
          $lineup = $row;
        }
    }
    $lineup['public_datetime'] = explode(" ",$lineup['public_datetime']);
    $lineup['public_datetime'] =  $lineup['public_datetime'][0];

}else {
  header("location:./lineup_board.php");
  exit();
}
include_once("./lineup.tpl.php");
?>
