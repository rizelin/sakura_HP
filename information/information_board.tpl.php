<?require_once("../require/header.php");?>
<div id="title_name"><h1>お知らせ</h1></div>
<?= isset($message)? "<div>$message</div>":'';?><?= isset($confirmMsg)? "<div>$confirmMsg</div>":'';?>
<div class="page">
  <ul class="information_list">
      <?foreach ($informationList as $key => $information) {?>
          <li>
              <p class="title"><a href='./information.php?id=<?=$information['id']?>'><?=$information['title']?></a></p>
              <span class="date"><?=$information['public_datetime']?></span>
          </li>
      <?}?>
  </section>
</div>

<div class="page_num">
    <? if ($page != 1){ ?>
      <a href="./information_board.php?page=1"><<</a>
    <?}

    for ($i=($page-5)<1? 1:($page-5); $i < ($page+5); $i++) {
        if ($i < $page) {?>
            <a href="./information_board.php?page=<?=$i?>"><?=$i?></a>
        <?}elseif ($i == $page) {?>
            <span class="current_page"><?=$i?></span>
        <?}elseif ($i <= $maxPage) {?>
            <a href="./information_board.php?page=<?=$i?>"><?=$i?></a>
        <?}
      }

    if ($page != $maxPage) {?>
        <a href="./information_board.php?page=<?=$maxPage?>">>></a>
    <?}?>
</div>
<?require_once("../require/footer.php");?>
