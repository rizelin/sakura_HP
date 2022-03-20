<!-- header -->
<?require_once("../require/header.php");?>
<nav id="breadcrumbs-nav">
    <ul class="breadcrumb">
        <li>
            <a href="../index.php">home</a>
            <span>/</span>
        </li>
        <li>経営者セミナー</li>
    </ul>
</nav>
<section class="writing">
    <div id="write_title">
        <h2 class="title"><?=$seminar['semi_title']?></h2>
        <p class="date"><?=$seminar['public_datetime'][0]?></p>
    </div>
    <div class="text"><?=$seminar['text']?></div>
</section>
<?if(isset($count)){ ?>
    <?for($i = 0;$i < $count; $i++){ ?>
        <section class="writing">
            <div class="text">
                <?=$schedule[$i]['address']?><br><br>
                <?=$schedule[$i]['entry_fee']?><br><br>
                <?=$schedule[$i]['start_time']?> ~ <?=$schedule[$i]['end_time']?>
            </div>
        </section>
    <?}?>
    <?if(!empty($count)){ ?>
        <dl class="write_list write_list_button">
            <a class="write_button2 write_button2_size" href="./seminar_inquiry_write.php?id=<?=$_GET['id']?>">セミナー申込み</a>
        </dl>
    <?}?>
<?}?>

<?require_once("../require/footer.php");?>
