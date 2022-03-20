<?require_once("../require/header.php");?>
<div id="title_name">
    <h1>お知らせ書き込み</h1>
</div>
    <form class="write_form" action="./information_update.php" method="post">
        <?if(isset($information['id'])){?>
            <input type="hidden" name="information[id]" value="<?= $information['id'] ?>">
            <input type="hidden" name="information[manager_id]" value="<?= $information['manager_id']?> ">
        <?}?>
        <dl>
            <dt><label class="write_name" for="title">タイトル</label></dt>
            <dd><input id="title" type="text" name="information[title]" value="<?=$information['title']?>"></dd>
            <?= $errorMsg['title']? "<span>{$errorMsg['title']}</span>":'' ?>
        </dl>
        <dl>
          <dt><label class="write_name sub_text textarea_name" for="text">本文</label></dt>
          <dd><textarea class="write_text" id="text" name="information[text]"><?= $information['text'] ?></textarea></dd>
          <?= $errorMsg['text']? "<span>{$errorMsg['text']}</span>":'' ?>
        </dl>
        <dl>
            <dt><label class="write_name" for="public_datetime">公開日付</label></dt>
            <dd>
                <input type="date" class="write_input date_size" name="information_datetime[public_date]" value="<?= $information['public_datetime'][0]?>">
                <input type="time" class="write_input date_size"  name="information_datetime[public_time]" value="<?= $information['public_datetime'][1]?>">
            </dd>
            <?= $errorMsg['public_datetime']? "<span>{$errorMsg['public_datetime']}</span>":'' ?>
        </dl>
        <dl>
            <dt><label class="write_name" for="limit_datetime">制限日付</label></dt>
            <dd>
                <input type="date" class="write_input date_size" name="information_datetime[limit_date]" value="<?= $information['limit_datetime'][0]?>">
                <input type="time" class="write_input date_size" name="information_datetime[limit_time]" value="<?= $information['limit_datetime'][1]?>">
            </dd>
            <?= $errorMsg['limit_datetime']? "<span>{$errorMsg['limit_datetime']}</span>":'' ?>
        </dl>
        <dl>
            <dt><label class="write_name" for="status">公開範囲</label></dt>
            <dd>
              <select class="status" name="information[status]">
              <option value=1 <?=($information['status']==1)? "selected":''?>>公開</option>
              <option value=2 <?=($information['status']==2)? "selected":''?>>非公開</option>
              <?if (isset($information['id'])) {?>
                    <option value=3 <?=($information['status']!=1 && $information['status']!=2)? $information['status']=3:''?>>削除</option>
              <?}?>
              </select>
            </dd>
        </dl>
        <dl class="fixed_button">
            <input class="" type="submit" value="登録">
        </dl>
    </form>

<?require_once("../require/footer.php");?>
