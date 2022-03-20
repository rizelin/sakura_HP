<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name">
    <h1>お問い合わせ</h1>
</div>

<form class="write_form" action="./inquiry_confirm.php" method="post">
    <div class="write_list_center">必要事項を入力し、「次へ」ボタンを押してください。<br>※印は必須項目となります。</div>
    <dl>
        <dt><label class="write_name" for="company">御社名※</label></dt>
        <dd><input class="write_input" id="company" type="text" name="inquiry[company]" value="<?=$inquiry['company']?>"></dd>
        <?= $errorMsgs['company']? "<span>{$errorMsgs['company']}</span>":''?>
      </dl>
    <dl>
        <dt><label class="write_name" for="name">お名前※</label></dt>
        <dd><input class="write_input"  id="name" type="text" name="inquiry[name]" value="<?=$inquiry['name']?>"></dd>
        <?= $errorMsgs['name']? "<span>{$errorMsgs['name']}</span>":''?>
    </dl>
    <dl>
        <dt><label class="write_name" for="email">メールアドレス※</label></dt>
        <dd><input class="write_input"  id="email" type="email" name="inquiry[email]" value="<?=$inquiry['email']?>"></dd>
        <?= $errorMsgs['email']? "<span>{$errorMsgs['email']}</span>":''?>
    </dl>
    <dl>
        <dt class="write_name"></dt>
        <dd>
          <label id="write_span" for="email2">確認のため２度入力ください</label>
          <input id="email2" class="write_input" type="email" name="inquiry[emailMatch]" value="<?=$inquiry['emailMatch']?>">
        </dd>
        <?= $errorMsgs['emailMatch']? "<span>{$errorMsgs['emailMatch']}</span>":''?>
        <?= $errorMsgs['emailConfirm']? "<span>{$errorMsgs['emailConfirm']}</span>":''?>
    </dl>
    <dl>
        <dt><label class="write_name" for="tel">お電話番号※</label></dt>
        <dd><input class="write_input" id="tel" type="text" name="inquiry[tel]" value="<?=$inquiry['tel']?>"></dd>
        <?= $errorMsgs['tel']? "<span>{$errorMsgs['tel']}</span>":''?>
    </dl>
    <dl>
          <dt class="write_name write_address">ご住所</dt>
          <dl class="write_address_input">
            <dt><label class="write_middle_name" for="zip_code">郵便番号</label></dt>
            <dd><input class="write_input" id="zip_code" type="text" name="inquiry[zip_code]" value="<?=$inquiry['zip_code']?>"></dd>
            <dt><label class="write_middle_name" for="prefecture">都道府県</label></dt>
            <dd>
              <select class="write_input" id="prefecture" name="inquiry[prefecture]">
                  <option value="">-</option>
                <?foreach ($prefectures as $key => $value) {?>
                  <option value="<?=$key?>" <?=$inquiry['prefecture']==$key? ' selected="selected"':'' ?>><?=$value?></option>
                <?}?>
              </select>
            </dd>
            <?= $errorMsgs['prefecture']? "<span>{$errorMsgs['prefecture']}</span>":''?>
            <dt><label class="write_middle_name" for="address1">市・区・郡・町</label><dt>
            <dd><input class="write_input" type="text" name="inquiry[address1]" value="<?=$inquiry['address1']?>"></dd>
            <dt><label class="write_middle_name" for="address2">番地・建物名等</label></dt>
            <dd><input class="write_input" type="text" name="inquiry[address2]" value="<?=$inquiry['address2']?>"></dd>
          </dl>
      </dl>
      <dl>
          <dt><label class="write_name sub_text textarea_name" for="text">本文</label></dt>
          <dd><textarea class="write_text" id="text" name="inquiry[text]"><?=$inquiry['text']?></textarea></dd>
          <?= $errorMsgs['text']? "<span>{$errorMsgs['text']}</span>":''?></div>
      </dl>
      <dl class="write_list write_list_button">
            <input class="write_button2 write_button2_size" type="submit" value="次へ">
      </dl>
  </form>

<?require_once("../require/footer.php");?>
