<!-- header -->
<?require_once("./header.php");?>

<div class="">
    <img src="http://minho.wj.am/common/media/20190117183732.jpg" alt="" width="100%">
</div>

<div class="main_border">
    <div class="main_list">
      <h2><a href="../lineup/lineup_board.php">主要商品</h2></a>
        <ul>
        <?for ($i=0; $i<=2; $i++) {?>
            <li>
                <img class="main_lineup_img" src="/common/img/lineup/<?=$lineupList[$i]['img']?>" alt="lineupList">
                <p><?=$lineupList[$i]['name']?></p>
            </li>
        <?}?>
      </ul>
    </div>
    <!-- お知らせ -->
    <div class="main_list">
        <h2><a href="../information/information_board.php">お知らせ</a></h2>
        <?foreach ($information_list as $key => $information) {?>
        <dl class="">
            <dd><?=$information['public_datetime']?></dd>
            <dt><a href="../information/information.php?id=<?=$information['id']?>"><?=$information['title']?></a></dt>
        </dl>
        <?}?>
    </div>
    <!-- セミナー -->
    <div class="main_list">
        <h2><a href="../seminar/seminar_board.php">セミナー</a></h2>
        <?foreach ($schedule_list as $key => $schedule){?>
        <dl class="">
            <dd><?=$schedule['start_time']?> ~ <?=$schedule['end_time']?></dd>
                <dt><a href="../seminar/seminar.php?id=<?=$schedule['seminar_id']?> "><?=$schedule['title']?> <?=$schedule['address']?></a> </dt>
            </dl>
        <?}?>
    </div>
</div>
<?require_once("./footer.php");?>
