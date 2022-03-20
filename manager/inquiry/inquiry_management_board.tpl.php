<?require_once("../require/header.php");?>

<div id="title_name"><h1>お問い合わせ状況</h1></div>
<?= $confirmMsg? "<div>$confirmMsg</div>":''?>
<div class="page">
    <table class="table_board">
      <tr>
          <th class="col_company">会社名</th>
          <th class="col_name">お名前</th>
          <th class="col_date">依頼日付</th>
          <th class="col_date">応答日付</th>
      </tr>
      <?for ($i=0; $i <$count ; $i++) {?>
        <tr>
          <td><a href="./inquiry_management.php?id=<?=$inquiryList[$i]['id']?>"><?=$inquiryList[$i]['company']?></td>
          <td><?=$inquiryList[$i]['name']?></td>
          <td><?=$inquiryList[$i]['registration_datetime']?></td>
          <?if (empty($inquiryList[$i]['response_datetime'])) {?>
              <td>未応答</td>
          <?}else {?>
                <td><?=$inquiryList[$i]['response_datetime']?></td>
          <?}?>
        </tr>
      <?}?>
    </table>
</div>
<div class="page_num">
    <?if ($page !=1) {?>
        <a href="./inquiry_management_board.php?page=1"><<</a>
    <?}

    for ($i=($page-5)<1? 1:($page-5); $i < ($page+5) ; $i++) {?>
      <?if ($i < $page) {?>
          <a href="./inquiry_management_board.php?page=<?=$i?>"> <?=$i?> </a>
      <?}elseif ($i == $page) {?>
          <span class="current_page"><?=$i?></span>
      <?}elseif ($i <= $maxPage) {?>
          <a href="./inquiry_management_board.php?page=<?=$i?>"> <?=$i?> </a>
    <?}?>
  <?}

  if ($page != $maxPage) {?>
      <a href="./inquiry_management_board.php?page=<?=$maxPage?>">>></a>
  <?}?>
</div>

<?require_once("../require/footer.php");?>
