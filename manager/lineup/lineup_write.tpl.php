<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name">
    <h1>商品追加</h1>
</div>
  <form class="write_form" method="post" action="./lineup_update.php" enctype="multipart/form-data">
        <? if(isset($lineup['id'])) {?>
            <input type="hidden" name="lineup[id]" value="<?= $lineup['id'] ?>">
        <?}?>
        <dl>
            <dt><label class="write_name" for="title">タイトル</label></dt>
            <dd><input type="text" id="title" class="write_title" name="lineup[name]" value="<?= $lineup['name'] ?>"></dd>
            <?= $errorMsg['name']? "<span>{$errorMsg['name']}</span>":'' ?>
        </dl>
        <dl>
            <dt><label class="write_name" for="caption">見出し</label></dt>
            <dd>
              <span id="write_span">※改行は「全角スペース」でできます。</span>
              <textarea class="write_sub_text" id="caption" class="write_caption" name="lineup[caption]"><?= $lineup['caption'] ?></textarea>
            </dd>
            <?= $errorMsg['caption']? "<span>{$errorMsg['caption']}</span>":'' ?>
        </dl>
        <dl>
            <dt><label class="write_name" for="img">見出しイメージ</label></dt>
            <dd><input id="img" type="file" name="img">
              <?if (!empty($lineup['img'])) {?>
                  <input type="hidden" name="lineup[img]" value="<?=$lineup['img']?>">
                  <img id="preview" src="/common/img/lineup/<?= $lineup['img'] ?>">
                  <input type="checkbox" id="img_delete" name="img_delete" value="1">
                  <label for="img_delete"> 写真削除 </label>
              <?}?>
            </dd>
            <?= $errorMsg['img']? "<span>{$errorMsg['img']}</span>":'' ?>
        </dl>
        <dl>
            <dt><label class="write_name sub_text textarea_name" for="text">本文</label></dt>
            <dd><textarea class="write_text" id="text" name="lineup[text]"><?= $lineup['text'] ?></textarea></dd>
            <?= $errorMsg['text']? "<span>{$errorMsg['text']}</span>":'' ?>
        </dl>

        <?if(!empty($_GET['id'])){?>
        <dl>
            <dt><label class="write_name" for="registration_datetime">作成日付</label></dt>
            <dd class="write_date" id="registration_datetime"><?=$lineup['registration_datetime']?></dd>
        </dl>
            <dl>
              <dt><label class="write_name" for="update_datetime">修正日付</label></dt>
              <dd class="write_date" id="registration_datetime"><?=$lineup['update_datetime']?></dd>
            </dl>
        <?}?>
        <dl>
            <dt><label class="write_name" for="public_datetime">公開日付</label></dt>
            <dd>
                <input type="date" class="write_input date_size" name="lineup_datetime[public_date]" value="<?= $lineup['public_datetime'][0]?>">
                <input type="time" class="write_input date_size" name="lineup_datetime[public_time]" value="<?= $lineup['public_datetime'][1]?>">
            </dd>
            <?= $errorMsg['public_datetime']? "<span>{$errorMsg['public_datetime']}</span>":'' ?>
        </dl>
        <dl>
            <dt><label class="write_name" for="limit_datetime">制限日付</label></dt>
            <dd>
                <input type="date" class="write_input date_size" name="lineup_datetime[limit_date]" value="<?=$lineup['limit_datetime'][0]?>">
                <input type="time" class="write_input date_size" name="lineup_datetime[limit_time]" value="<?=$lineup['limit_datetime'][1]?>">
            </dd>
        </dl>
        <dl>
            <dt><label class="write_name">公開範囲</label></dt>
            <dd>
              <select id="status" class="write_input" name="lineup[status]">
                    <option value=1 <?= ($lineup['status']==1)? "selected":"" ?> >公開</option>
                    <option value=2 <?= ($lineup['status']==2)? "selected":"" ?>>非公開</option>
                    <?if (isset($lineup['id'])) { ?>
                        <option value=3 <?= ($lineup['status']!=1 && $lineup['status']!=2)? $lineup['status']=3:"" ?>>
                            削除
                        </option>
                    <?}?>
                </select>
            </dd>
        </dl>
        <dl>
            <dt><label class="write_name">トップページ公開</label></dt>
            <input type="checkbox" name="lineup[top_preview]" value="1" <?=($lineup['top_preview']==1)? 'checked':''?>>
        </dl>
        <div class="write_list write_list_button">
            <input class="write_button2 write_button2_size" type="submit" value="登録">
        </div>
  </form>

<?require_once("../require/footer.php");?>
