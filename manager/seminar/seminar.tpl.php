<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name">
    <h1>経営者セミナー</h1>
</div>
<dl class="writing">
    <dt class="title"><?=$seminar['semi_title']?></dt>
    <dd class="date"><?=$seminar['public_datetime'][0]?></dd>
    <dd class="text"><?=$seminar['text']?></dd>
</dl>
<?if(isset($count)){ ?>
    <?for($i = 0;$i < $count; $i++){ ?>
        <dl class="writing">
            <dd class="text">
                <?=$schedule[$i]['address']?><br><br>
                <?=$schedule[$i]['entry_fee']?><br><br>
                <?=$schedule[$i]['start_time']?> ~ <?=$schedule[$i]['end_time']?>
            </dd>
        </dl>
    <?}?>
    <?if(!empty($count)){ ?>
        <dl class="write_list write_list_button">
            <a class="write_button2 write_button2_size" href="./seminar_inquiry_write.php?id=<?=$_GET['id']?>">セミナー申込み</a>
        </dl>
    <?}?>
<?}?>

<?require_once("../require/footer.php");?>
