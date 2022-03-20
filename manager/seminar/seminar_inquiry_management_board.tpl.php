<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name"><h1>セミナー予約状況</h1></div>
  <form class="select" action="./seminar_inquiry_management_board.php" method="get">
      <select class="seminar_select" name="seminar_id">
          <option value="0" >全体</option>
          <?for($i=0 ; $i < $seminarCount ; $i++){?>
              <option value="<?=$seminarArray[$i]['id']?>"<?=($seminarArray[$i]['id']==$_GET['seminar_id']) ? "selected" :''?>><?=$seminarArray[$i]['title']?></option>
          <?}?>
      </select>
      <input type="submit" name="" value="検索">
  </form>
 <div class="page">
   <table class="table_board">
      <tr>
          <th class="col_schedule">セミナースケジュール</th>
          <th class="col_date">日付</th>
          <th class="col_company">御社名</th>
          <th class="col_name">代表者名</th>
          <th class="col_email">メールアドレス</th>
          <th class="col_tel">電話番号</th>
          <th class="col_num">参加希望者数</th>
          <th class="col_date">参席者更新日付</th>
          <th class="col_num">実際参席者数</th>
          <th class="col_date">申込み日付</th>
      </tr>
      <?for($i=0; $i < $count; $i++) {?>
      <tr>
          <td><a href="./seminar_inquiry_management.php?id=<?=$seminarInquiry[$i]['id']?>"><?=$seminarInquiry[$i]['title']?></a></td>
          <td><?=$seminarInquiry[$i]['start_time']?></td>
          <td><?=$seminarInquiry[$i]['company']?></td>
          <td><?=$seminarInquiry[$i]['name']?></td>
          <td><?=$seminarInquiry[$i]['email']?></td>
          <td><?=$seminarInquiry[$i]['tel']?></td>
          <td><?=$seminarInquiry[$i]['reservation_count']?></td>
          <td><?=$seminarInquiry[$i]['update_datetime']?></td>
          <td><?=$seminarInquiry[$i]['attended_count']?></td>
          <td><?=$seminarInquiry[$i]['registration_datetime']?></td>
      </tr>
      <?}?>
  </table>
</div>

<div class="page_num">
    <?if($page != 1){?>
        <a class="prev_page" href="./seminar_inquiry_management_board?page=1&seminar_id=<?=$_GET['seminar_id']?>"><<</a>
    <?}
    for ($i=($page-5)<1? 1 : ($page-5); $i < ($page+5); $i++) {
        if ($i < $page) {?>
            <a href="./seminar_inquiry_management_board?page=<?=$i?>&seminar_id=<?=$_GET['seminar_id']?>"><?=$i?></a>
        <?}elseif($i == $page) {?>
            <span class="current_page"><?=$i?></span>
        <?}elseif($i <= $maxPage) {?>
            <a href="./seminar_inquiry_management_board?page=<?=$i?>&seminar_id=<?=$_GET['seminar_id']?>"><?=$i?></a>
        <?}
    }?>
    <?if($page != $maxPage){?>
        <a class="next_page" href="./seminar_inquiry_management_board?page=<?=$maxPage?>&seminar_id=<?=$_GET['seminar_id']?>">>></a>
    <?}?>
</div>

<?require_once("../require/footer.php");?>
