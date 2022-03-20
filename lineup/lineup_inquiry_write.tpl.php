<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name">
<h1>お見積りご依頼</h1>
</div>
    <form class="write_form" action="./lineup_inquiry_confirm.php" method="post">
      <p class="write_list_center">必要事項を入力し、「次へ」ボタンを押してください。<br>※印は必須項目となります。<br>お見積り希望の商品（重複選択可能）※</p>
      <dl>
        <dt class="write_name product_check"><label>依頼商品※</label></dt>
        <dl class="write_address_input">
            <?foreach ($lineupList as $key => $value) {?>
                <dd>
                  <input type="checkbox" id="lineup<?=$value['id']?>" name="lineup_inquiry[select_lineup][<?=$value['id']?>]" value="1" <?= isset($lineupInquiry['select_lineup'][$value['id']])? ' checked="checked"':''?> >
                  <label for="lineup<?=$value['id']?>"> <?=$value['name']?> </label>
                </dd>
            <?}?>
            <?= $errorMsgs['select_lineup']? "<span>{$errorMsgs['select_lineup']}</span>":''?>
        </dl>
    </dl>
    <dl>
        <dt><label class="write_name" for="inquiry_company">会社名※</label></dt>
        <dd><input class="write_input" id="inquiry_company" type="text" name="lineup_inquiry[company]" value="<?=$lineupInquiry['company']?>"></dd>
        <?= $errorMsgs['company']? "<span>{$errorMsgs['company']}</span>":''?>
    </dl>
    <dl>
        <dt><label class="write_name" for="inquiry_name">お名前※</label></dt>
        <dd><input class="write_input" type="text" name="lineup_inquiry[name]" value="<?=$lineupInquiry['name']?>"></dd>
        <?= $errorMsgs['name']? "<span>{$errorMsgs['name']}</span>":''?>
    </dl>
    <dl>
       <dt><label class="write_name" for="inquiry_email">メールアドレス※</label>
       <dd><input class="write_input" type="email" name="lineup_inquiry[email]" value="<?=$lineupInquiry['email']?>"></dd>
       <?= $errorMsgs['email']? "<span>{$errorMsgs['email']}</span>":''?>
    </dl>
    <dl>
      <dt class="write_name"></dt>
      <dd>
        <label id="write_span" for="inquiry_email2">確認のため２度入力ください</label>
        <input id="inquiry_email2" class="write_input" type="email" name="lineup_inquiry[emailMatch]" value="<?=$lineupInquiry['emailMatch']?>">
      </dd>
      <?= $errorMsgs['emailMatch']? "<span>{$errorMsgs['emailMatch']}</span>":''?>
      <?= $errorMsgs['emailConfirm']? "<span>{$errorMsgs['emailConfirm']}</span>":''?>
    </dl>
    <dl>
      <dt><label class="write_name" for="inquiry_tel">お電話番号※</label></dt>
      <dd><input class="write_input" type="text" name="lineup_inquiry[tel]" value="<?=$lineupInquiry['tel']?>"></dd>
      <?= $errorMsgs['tel']? "<span>{$errorMsgs['tel']}</span>":''?>
    </dl>
    <dl>
        <dt class="write_name write_address">ご住所</dt>
        <dl class="write_address_input">
            <dt><label class="write_middle_name" for="inquiry_zip">郵便番号</label></dt>
            <dd><input class="write_input" type="text" name="lineup_inquiry[zip_code]" value="<?=$lineupInquiry['zip_code']?>"></dd>
            <dt><label class="write_middle_name" for="inquriy_prefecture">都道府県</label></dt>
            <dd>
                <select class="write_input" id="inquriy_prefecture" name="lineup_inquiry[prefecture]">
                    <option value="">-</option>
                      <?foreach ($prefectures as $key => $value) {?>
                          <option value="<?=$key?>" <?=$lineupInquiry['prefecture']==$key? ' selected="selected"':'' ?>><?=$value?><br></option>
                      <?}?>
                </select>
            </dd>
            <?= $errorMsgs['prefecture']? "<span>{$errorMsgs['prefecture']}</span>":''?>
            <dt><label class="write_middle_name" for="address1">市・区・郡・町</label></dt>
            <dd><input class="write_input" type="text" name="lineup_inquiry[address1]" value="<?=$lineupInquiry['address1']?>"></dd>
            <dt><label class="write_middle_name" for="address2">番地・建物名等</label></dt>
            <dd><input class="write_input" type="text" name="lineup_inquiry[address2]" value="<?=$lineupInquiry['address2']?>"></dd>
        </dl>
    </dl>
    <dl>
      <dt><label class="write_name sub_text textarea_name" for="text">本文</label></dt>
      <dd><textarea class="write_text" id="text" name="lineup_inquiry[text]"><?=$lineupInquiry['text']?></textarea></dd>
      <?= $errorMsgs['text']? "<span>{$errorMsgs['text']}</span>":''?>
   </dl>
   <dl class="write_list write_list_button">
      <input class="write_button2 write_button2_size" type="submit" value="次へ">
   </dl>
    </form>
<?require_once("../require/footer.php");?>
