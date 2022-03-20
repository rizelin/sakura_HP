<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name"><h1>商品ラインアップ</h1></div>
    <dl class="writing">
      <dt class="title"><?= $lineup['name'] ?></dt>
      <dd class="date"><?= $lineup['public_datetime']?></dd>
      <dd class="text"><?= $lineup['text'] ?></dd>
      <input type="button" class="request_button" onclick="location.href='./lineup_inquiry_write.php'" value="お見積り依頼はこちら">
    </dl>
<?require_once("../require/footer.php");?>
