<!-- header -->
<?require_once("../require/header.php");?>

<div id="title_name">
    <h1>固定ページ書き込み</h1>
</div>
    <form class="write_form" action="./fixed.php" method="post">
        <input type="hidden" name="fixed[id]" value="<?=$fixed['id']?>">
        <dl>
          <dt><label class="write_name" for="title">タイトル</label></dt>
          <dd><input id="title" type="text" name="fixed[title]" value="<?=$fixed['title']?>"></dd>
          <?= $errorMsgs['title']? "<span>{$errorMsgs['title']}</span>":'' ?>
        </dl>
        <dl>
          <dt><label class="write_name write_name_text textarea_name" for="text">本文</label></dt>
          <dd><textarea class="write_text" id="text"  name="fixed[text]"><?=$fixed['text']?></textarea></dd>
          <?= $errorMsgs['text']? "<span>{$errorMsgs['text']}</span>":'' ?>
        </dl>
        <dl>
          <dt><label class="write_name" for="public_datetime">公開日付</label></dt>
          <dd>
              <input type="date" class="write_input date_size" name="fixed_datetime[public_date]" value="<?= $fixed['public_datetime'][0]?>">
              <input type="time" class="write_input date_size" name="fixed_datetime[public_time]" value="<?= $fixed['public_datetime'][1]?>">
          </dd>
          <?= $errorMsgs['public_datetime']? "<span>{$errorMsgs['public_datetime']}</span>":'' ?>
        </dl>
        <dl>
          <dt><label class="write_name" for="limit_datetime">制限日付</label></dt>
          <dd>
              <input type="date" class="write_input date_size" name="fixed_datetime[limit_date]" value="<?= $fixed['limit_datetime'][0]?>">
              <input type="time" class="write_input date_size" name="fixed_datetime[limit_time]" value="<?= $fixed['limit_datetime'][1]?>">
          <dd>
          <?= $errorMsgs['limit_datetime']? "<span>{$errorMsgs['limit_datetime']}</span>":'' ?>
        </dl>
        <dl>
          <dt><label class="write_name" for="status">公開範囲</label></dt>
          <dd>
            <select class="status" name="fixed[status]">
                <option value=1 <?= ($fixed['status']==1)? "selected":"" ?> >公開</option>
                <option value=2 <?= ($fixed['status']==2)? "selected":"" ?>>非公開</option>
                <?if (isset($fixed['id'])) { ?>
                    <option value=3 <?= ($fixed['status']!=1 && $fixed['status']!=2)? $fixed['status']=3:"" ?>>
                        削除
                    </option>
                <?}?>
            </select>
          </dd>
        </dl>
        <dl class="fixed_button">
          <input type="submit" value="登録">
        </dl>
    </form>

<?require_once("../require/footer.php");?>
