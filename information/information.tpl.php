<!-- header -->
<?require_once("../require/header.php");?>
<nav id="breadcrumbs-nav">
  <ul class="breadcrumb">
    <li>
      <a href="../index.php">home</a>
      <span>/</span>
    </li>
    <li>
      お知らせ
    </li>
  </ul>
</nav>

    <section class="writing">
      <div id="write_title">
        <h2 class="title"><?= $information['title'] ?></h2>
        <p class="date"><?= $information['public_datetime']?></p>
      </div>
      <p class="text"><?= $information['text'] ?></p>
    </section>
<?require_once("../require/footer.php");?>
