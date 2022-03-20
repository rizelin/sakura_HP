<?require_once("../require/header.php");?>

<h2 class="management_title">お問い合わせ内容</h2>
<form action="./inquiry_management.php" method="post">
  <table class="management_table">
        <tr>
            <th>お問い合わせ日付</th>
            <td><?=$inquiryList['registration_datetime']?></td>
        </tr>
        <tr>
            <th>応答日付</th>
            <?if ($inquiryList['response_detatime'] != NULL) {?>
              <td><?=$inquiryList['response_datetime']?></td>
            <?}else {?>
                <td>ご応答お願いいたします。</td>
            <?}?>
        </tr>
        <tr>
            <th>会社名</th>
            <td><?=$inquiryList['company']?></td>
        </tr>
        <tr>
            <th>お名前</th>
            <td><?=$inquiryList['name']?></td>
        </tr>
        <tr>
            <th>本文</th>
            <td><?=$inquiryList['text']?></td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td><?=$inquiryList['email']?></td>
        </tr>
        <tr>
            <th>お電話番号</th>
            <td><?=$inquiryList['tel']?></td>
        </tr>
        <tr>
            <th>ご住所</th>
            <td><?=$inquiryList['zip_code']?><br><?=$prefecture.$inquiryList['address1']?><br><?=$inquiryList['address2']?></td>
        </tr>
    </table>
    <div class="management_button">
    <?if ($inquiryList['response_datetime'] == NULL) {?>
        <div class="checked">
            <input type="checkbox" id="confirm_checked" name="confirm_checked" value="<?=$inquiryList['id']?>">
            <label for="confirm_checked">応答完了しました。</label>
        </div>
        <input type="submit" value="完了">
    <?}?>
        <input type="button" value="戻る" onclick="location='./inquiry_management_board.php'">
    </div>
</form>

<?require_once("../require/footer.php");?>
