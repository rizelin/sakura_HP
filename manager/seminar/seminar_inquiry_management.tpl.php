<!-- header -->
<?require_once("../require/header.php");?>
<h2 class="management_title">セミナー参加者状況</h2>
<form class="" action="./seminar_inquiry_management.php" method="post">
    <input type="hidden" name="id" value="<?=$_GET['id']?>">
    <table class="management_table">
        <tr>
          <th>参席希望者</th>
          <td><?=$message['reservation_count']?>名<td>
        </tr>
        <tr>
          <th>実際参席者数</th>
          <td><input type="text" name="attended_count" value="<?=$message['attended_count']?>">名</td>
        </tr>
    </table>
    <div class="management_button">
        <input type="submit" value="完了">
    <div>
    <?if(isset($errorMsgs)){?>
      <div><?=$errorMsgs?></div>
    <?}?>
</form>

<?require_once("../require/footer.php");?>
