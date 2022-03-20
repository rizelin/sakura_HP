<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name"><h1>商品依頼状況</h1></div>
<?= isset($confirmMsg)? "<div>$confirmMsg</div>":'' ?>
<div class="page">
    <table class="table_board">
      <tr>
          <th class="col_date">依頼日付</th>
          <th class="col_product">依頼商品</th>
          <th class="col_company">会社名</th>
          <th class="col_name">お名前</th>
          <th class="col_date">応答日付</th>
      </tr>
      <?for ($i=0; $i < $count; $i++) {?>
      <tr>
          <td><?=$lineupInquiryList[$i]['registration_datetime']?></td>
          <td><?=$lineupInquiryList[$i]['lineup_name']?></td>
          <td><a href="./lineup_inquiry_management.php?id=<?=$lineupInquiryList[$i]['id']?>" style="text-decoration:none"><?=$lineupInquiryList[$i]['company']?></a></td>
          <td><?=$lineupInquiryList[$i]['name']?></td>
          <?if (empty($lineupInquiryList[$i]['response_datetime'])){?>
            <td>未応答</td>
          <?}else {?>
              <td><?=$lineupInquiryList[$i]['response_datetime']?></td>
          <?}?>
      </tr>
      <?}?>
    </table>
</div>

<div class="page_num">
  <? if ($page != 1){ ?>
        <a href="./lineup_inquiry_management_board.php?page=1"><<</a>
  <?}
    for ($i=($page-5)<1? 1:($page-5); $i < ($page+5); $i++) {
        if ($i < $page) {?>
            <a href="./lineup_inquiry_management_board.php?page=<?=$i?>"><?=$i?></a>
      <?}elseif ($i == $page) {?>
            <span class="current_page"><?=$i?></span>
      <?}elseif ($i <= $maxPage) {?>
            <a href="./lineup_inquiry_management_board.php?page=<?=$i?>"><?=$i?></a>
      <?}
    }
      if ($page != $maxPage) {?>
          <a href="./lineup_inquiry_management_board.php?page=<?=$maxPage?>">>></a>
      <?}?>
</div>

<?require_once("../require/footer.php");?>
