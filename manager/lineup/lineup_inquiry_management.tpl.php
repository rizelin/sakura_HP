<?require_once("../require/header.php");?>

<h2 class="management_title">お見積りご依頼内容</h2>
<form action="./lineup_inquiry_management.php" method="post">
  <table class="management_table">
      <tr>
        <th>依頼日付</th>
        <td><?=$lineupInquiryList['registration_datetime']?></td>
      </tr>
      <tr>
        <th>応答日付</th>
        <?if ($lineupInquiryList['response_datetime'] != NULL) {?>
            <td><?=$lineupInquiryList['response_datetime']?></td>
        <?}else {?>
            <td>ご応答お願いいたします。</td>
        <?}?>
      </tr>
      <tr>
        <th>お見積り希望の商品</th>
        <td><?=$lineupName?></td>
      </tr>
      <tr>
        <th>会社名</th>
        <td><?=$lineupInquiryList['company']?></td>
      </tr>
      <tr>
        <th>お名前</th>
        <td><?=$lineupInquiryList['name']?></td>
      </tr>
      <tr>
        <th>本文</th>
        <td><?=$lineupInquiryList['text']?></td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td><?=$lineupInquiryList['email']?></td>
      </tr>
      <tr>
        <th>お電話番号</th>
        <td><?=$lineupInquiryList['tel']?></td>
      </tr>
      <tr>
        <th>ご住所</th>
        <td><?= $lineupInquiryList['zip_code']?><br><?= $prefecture.$lineupInquiryList['adivress1']?><br><?=$lineupInquiryList['adivress2']?></td>
      </tr>
  </table>
  <div class="management_button">
    <?if ($lineupInquiryList['response_datetime'] == NULL) {?>
        <div class="checked">
            <input type="checkbox" id="confirm_checked" name="confirm_checked" value="<?=$lineupInquiryList['inquiry_id']?>">
            <label for="confirm_checked">応答完了しました。</label>
        </div>
        <input type="submit" value="完了">
    <?}?>
        <input type="button" value="戻る" onClick="location.href='./lineup_inquiry_management_board.php'">
  </div>
</form>

<?require_once("../require/footer.php");?>
