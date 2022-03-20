<!-- header -->
<?require_once("../require/header.php");?>

<h2 class="confirm_title">お見積りご依頼の確認</h2>
<p class="confirm_annotation">ご記入いただきました内容をご確認の上「送信」ボタンを押してください。</p>
  <form action="./lineup_inquiry_confirm.php" method="post">
    <input type="hidden" name="confirm">
    <table class="confirm_table">
      <tr>
        <th>お見積り希望の商品</th>
        <td><?=$selectedList?></td>
      </tr>
      <tr>
        <th>会社名</th>
        <td><?=$lineupInquiry['company']?></td>
      </tr>
      <tr>
        <th>お名前</th>
        <td><?=$lineupInquiry['name']?></td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td><?=$lineupInquiry['email']?></td>
      </tr>
      <tr>
        <th>お電話番号</th>
        <td><?=$lineupInquiry['tel']?></td>
      </tr>
      <tr>
        <th>ご住所</th>
        <td><?= $lineupInquiry['zip_code']?><br><?= $prefecture.$lineupInquiry['address1']?><br><?=$lineupInquiry['address2']?></td>
      </tr>
      <tr>
        <th>本文</th>
        <td><?=$lineupInquiry['text']?></td>
      </tr>
    </table>
    <div class="confirm_button">
      <input type="submit" value="送信する">
      <input type="button" value="戻る" onclick="location='./lineup_inquiry_write.php'">
    </div>
  </form>

<?require_once("../require/footer.php");?>
