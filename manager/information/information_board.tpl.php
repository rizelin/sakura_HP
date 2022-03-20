<?require_once("../require/header.php");?>
<div id="title_name"><h1>お知らせ</h1></div>
<?= isset($message)? "<p id='notice_message'>$message</p>":'';?><?= isset($confirmMsg)? "<p id='notice_message'>$confirmMsg</p>":'';?>
<div class="page">
    <table class="table_board">
      <tr>
        <th class="col_title">タイトル</th>
        <th class="col_name">作成者</th>
        <th class="col_date">作成日付</th>
        <th class="col_date">公開日付</th>
        <th class="col_status">公開範囲</th>
      </tr>
<?foreach ($informationList as $key => $information) {?>
      <tr>
        <td><a href='./information_write.php?id=<?=$information['id']?>' style="text-decoration:none;"><?=$information['title']?></a></td>
        <td><?=$information['name']?></td>
        <td><?=$information['registration_datetime']?></td>
        <td><?=$information['public_datetime']?></td>
        <td><?=$information['status']?></td>
      </tr>
<?}?>
    </table>
    <div class="write_button"><input type="button" value="作成" onClick="location='./information_write.php'"></div>
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
