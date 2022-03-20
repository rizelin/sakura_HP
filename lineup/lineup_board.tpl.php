<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name"><h1>商品ラインアップ</h1></div>
    <?= isset($message)? "<div>$message</div>":'';?>
    <?= isset($confirmMsg)? "<div>$confirmMsg</div>":'';?>
    <div class="page">
    <?for ($i=0; $i <$count; $i++) {?>
      <div class="page_list">
        <div class="page_title"><?=$lineupList[$i]['name']?></div>
        <div class="page_img">
          <?if (isset($lineupList[$i]['img'])) {?>
                <img src="/common/img/lineup/<?=$lineupList[$i]['img']?>">
          <?}else {?>
                <img src="/common/img/noImage.png" alt="イメージがありません">
          <?}?>
      </div>
          <div class="title_text">
              <?=$lineupList[$i]['caption']?>
              <div class="page_button"><a href="./lineup.php?id=<?=$lineupList[$i]['id']?>"><div><?=$tagName[$i]?>のご紹介はコチラから</div></a></div>
          </div>
      </div>
    <?}?>
    </div>

    <div class="page_num">
    <?if ($page != 1) {?>
        <a class="prev_page" href="./lineup_board.php?page=1"><<</a>
    <?}
    for ($i=($page-5)<1? 1:($page-5); $i<($page+5); $i++) {
        if ($i < $page) {?>
          <a class="pages" href="./lineup_board.php?page=<?=$i?>"><?=$i?></a>
      <?}elseif ($i == $page) {?>
          <span class="current_page"><?=$i?></span>
      <?}elseif ($i <= $maxPage) {?>
          <a class="pages" href="./lineup_board.php?page=<?=$i?>"><?=$i?></a>
      <?}
    }
    if ($page != $maxPage) {?>
      <a class="next_page" href="./lineup_board.php?page=<?=$maxPage?>">>></a>
    <?}?>
    </div>

<?require_once("../require/footer.php");?>
