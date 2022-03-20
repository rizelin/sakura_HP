<!-- header -->
<?require_once("../require/header.php");?>
<nav id="breadcrumbs-nav">
  <ul class="breadcrumb">
    <li>
      <a href="../index.php">home</a>
      <span>/</span>
    </li>
    <li>
      商品ラインアップ
    </li>
  </ul>
</nav>

    <section class="writing">
      <div id="write_title">
        <h2 class="title"><?= $lineup['name'] ?></h2>
        <p class="date"><?= $lineup['public_datetime']?></p>
      </div>
      <div class="text"><?= $lineup['text'] ?></div>
      <input type="button" class="request_button" onclick="location.href='./lineup_inquiry_write.php'" value="お見積り依頼はこちら">
    </section>
<?require_once("../require/footer.php");?>
