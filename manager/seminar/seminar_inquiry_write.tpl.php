<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name">
    <h1>セミナー参加申し込み</h1>
</div>
    <form class="fixed_form" action="./seminar_inquiry_confirm.php" method="post">
        <dl>
            <dt><label class="write_name" for="seminar_inquiry">セミナー日付選択</label></dt>
            <dd>
                <input class="write_input" type="hidden" name="id" value="<?=$_GET['id']?>">
                <select id="seminar_inquiry" class="" name="seminar_inquiry[id]">
                    <?for ($i = 0; $i < $count; $i++) {?>
                        <option value="<?=$schedule[$i]['id']?>"><?=$schedule[$i]['start_time']?>
                        ~ <?=$schedule[$i]['end_time']?> / <?=$schedule[$i]['address']?> </option>
                        <?}?>
                        <?if(isset($seminarInquiryError['id'])){?>
                            <div class=""><?=$seminarInquiryError['id']?> </div>
                        <?}?>
                </select>
            </dd>
        </dl>
        <dl>
            <dt><label class="write_name" for="inquiry_company">御社名※</label></dt>
            <dd>
                <input class="write_input" id="inquiry_company" type="text" name="inquiry[company]" value="<?=$inquiry['company']?>"><br>
                <?if(isset($inquiryErrors['company'])){?>
                    <?=$inquiryErrors['company']?>
                <?}?>
            </dd>
        </dl>
        <dl>
            <dt><label class="write_name" for="inquiry_name">お名前※</label></dt>
            <dd>
                <input class="write_input" id="inquiry_name" type="text" name="inquiry[name]" value="<?=$inquiry['name']?>"><br>
                <?if(isset($inquiryErrors['name'])){?>
                    <?= $inquiryErrors['name']?>
                <?}?>
            </dd>
        </dl>
        <dl>
            <dt><label class="write_name" for="inquiry_email">メールアドレス※</label></dt>
            <dd>
                <input class="write_input" id="inquiry_email" type="text" name="inquiry[email]" value="<?=$inquiry['email']?>"><br>
                <?if(isset($inquiryErrors['email'])){?>
                    <div class=""><?=$inquiryErrors['email']?></div>
                <?}elseif(isset($inquiryErrors['emailCheck'])){?>
                    <div class=""><?=$inquiryErrors['emailCheck']?> </div>
                <?}?>
            </dd>
        </dl>
        <dl>
            <dt class="write_name"></dt>
            <dd>
                <label id="email_label" for="email2">確認のため２度入力ください</label>
                <input class="write_input" id="email2" type="text" name="inquiry[emailMatch]" value="<?=$inquiry['emailMatch']?>">
                <?if(isset($inquiryErrors['emailMatchCheck'])){?>
                    <div><?=$inquiryErrors['emailMatchCheck']?></div>
                <?}?>
            </dd>
        </dl>
        <dl>
            <dt><label class="write_name" for="tel">お電話番号</label></dt>
            <dd>
                <input class="write_input" id="tel" type="text" name="inquiry[tel]" value="<?=$inquiry['tel']?>">
                <?if(isset($inquiryErrors['tel'])){?>
                    <div><?=$inquiryErrors['tel']?> </div>
                <?}?>
            </dd>
        </dl>
        <dl>
            <dt><label class="write_name" for="inquiry_count">参加者</label></dt>
            <dd>
                <select class="write_input" id="inquiry_count" name="seminar_inquiry[reservation_count]">
                    <?for ($i=1; $i < 11; $i++) {?>
                            <option value="<?=$i?>"><?=$i?></option>
                    <?}?>
                </select>
                <?if(isset($seminarInquiryError['reservation_count'])){?>
                    <div><?=$seminarInquiryError['reservation_count']?></div>
                <?}?>
            </dd>
        </dl>
        <dl class="fixed_button">
            <input class="" type="submit" value="送信"><br>
        </dl>
    </form>
<?require_once("../require/footer.php");?>
