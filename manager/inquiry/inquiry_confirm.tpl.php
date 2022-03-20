<?require_once("../require/header.php");?>

<h2 class="confirm_title">お問合せの確認</h2>
<p class="confirm_annotation">ご記入いただきました内容をご確認の上「送信」ボタンを押してください。</p>
  <form action="./inquiry_confirm.php" method="post">
    <input type="hidden" name="confirm[]">
    <table class="confirm_table">
      <tr>
        <th>会社名</th>
        <td><?=$inquiry['company']?></td>
      </tr>
      <tr>
        <th>お名前</th>
        <td><?=$inquiry['name']?></td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td><?=$inquiry['email']?></td>
      </tr>
      <tr>
        <th>お電話番号</th>
        <td><?=$inquiry['tel']?></td>
      </tr>
      <tr>
        <th>ご住所</th>
        <td><?= $inquiry['zip_code']?><br><?= $prefecture.$inquiry['adivress1']?><br><?=$inquiry['adivress2']?></td>
      </tr>
      <tr>
        <th>本文</th>
        <td><?=$inquiry['text']?></td>
      </tr>
    </table>
    <div class="confirm_button">
        <input type="submit" value="送信する">
        <input type="button" value="戻る" onClick="location.href='./inquiry_write.php'">
    </div>
</form>

<?require_once("../require/footer.php");?>
