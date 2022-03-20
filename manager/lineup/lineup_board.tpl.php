<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name"><h1>商品ラインアップ</h1></div>
    <?= isset($message)? "<p id='notice_message'>$message</p>":'';?>
    <?= isset($confirmMsg)? "<p id='notice_message'>$confirmMsg</p>":'';?>
    <div class="page">
    <?for ($i=0; $i <$count; $i++) {?>
      <div class="page_list">
        <?if (isset($lineupList[$i]['img'])) {?>
          <div class="page_img">
              <img src="/common/img/lineup/<?=$lineupList[$i]['img']?>">
          </div>
        <?}?>
          <div class="title_text">
              <div class="page_title"><?=$lineupList[$i]['name']?></div>
              <dl class="page_caption"><?=$lineupList[$i]['caption']?></dl>
              <div class="page_button">
                <a href="./lineup_write.php?id=<?=$lineupList[$i]['id']?>"><div>修正</div></a>
                <a href="./lineup.php?id=<?=$lineupList[$i]['id']?>"><div>記事確認</div></a>
              </div>
          </div>
      </div>
    <?}?>
      <div class="write_button">
        <input type="button" value="依頼状況" onclick="location='./lineup_inquiry_management.php'">
        <input type="button" value="作成" onclick="location='./lineup_write.php'">
      </div>
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
