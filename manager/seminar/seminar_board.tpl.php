<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name"><h1>経営者セミナー</h1></div>
    <?= isset($message)? "<p id='notice_message'>$message</p>":'';?>
    <?= isset($confirmMsg)? "<p id='notice_message'>$confirmMsg</p>":'';?>
<div class="page">
  <?foreach ($seminarList as $key => $value ){?>
    <div class="page_list">
      <?if(!empty($value['img'])){?>
          <div class="page_img">
              <img src="/common/img/seminar/<?=$value['img']?>" alt="イメージがありません">
          </div>
      <?}?>
        <div class="title_text">
            <div class="page_title"><?=$value['title']?></div>
            <div class="page_caption"><?=$value['caption']?></div>
            <div class="page_button">
              <a href="./seminar_write.php?id=<?=$value['id']?>"><div>修正</div></a>
              <a href="./seminar.php?id=<?=$value['id']?>"><div>記事確認</div></a>
            </div>
        </div>
    </div>
  <?}?>
    <div class="write_button">
        <input type="button" value="予約状況" onclick="location.href='./seminar_inquiry_management_board.php'">
        <input type="button" value="作成" onclick="location.href='./seminar_write.php'">
    </div>
</div>

<div class="page_num">
  <?if($page != 1) {?>
    <a class="prev_page" href="./seminar_board.php?page=1"><<</a>
  <?}
    for($i=($page-5)<1?1:($page-5);$i<($page+5);$i++) {
        if($i < $page) {?>
            <a class="pages" href="./seminar_board.php?page=<?=$i?>"><?=$i?></a>
        <?}elseif($i == $page) {?>
            <span class="current_page"><?=$i?></span>
        <?}elseif($i <= $maxPage) {?>
            <a class="pages" href="./seminar_board.php?page=<?=$i?>"><?=$i?></a>
        <?}
    }?>
  <?if($page != $maxPage) {?>
      <a class="next_page" href="./seminar_board.php?page=<?=$maxPage?>">>></a>
  <?}?>
</div>

<?require_once("../require/footer.php");?>
