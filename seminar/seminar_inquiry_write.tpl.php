<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name">
    <h1>セミナー参加申し込み</h1>
</div>
    <form class="write_form" action="./seminar_inquiry_confirm.php" method="post">
        <dl>
            <dt><label class="write_name" for="seminar_inquiry">セミナー日付選択</label></dt>
            <dd>
                <input type="hidden" name="id" value="<?=$_GET['id']?>">
                <select id="seminar_inquiry" class="write_input" name="seminar_inquiry[id]">
                    <?for ($i = 0; $i < $count; $i++) {?>
                        <option value="<?=$schedule[$i]['id']?>"><?=$schedule[$i]['start_time']?>
                        ~ <?=$schedule[$i]['end_time']?> / <?=$schedule[$i]['address']?> </option>
                        <?}?>
                </select>
                <?if(isset($seminarInquiryError['id'])){?>
                    <span><?=$seminarInquiryError['id']?> </span>
                <?}?>
            </dd>
        </dl>
        <dl>
            <dt><label class="write_name" for="inquiry_company">御社名※</label></dt>
            <dd><input class="write_input" id="inquiry_company" type="text" name="inquiry[company]" value="<?=$inquiry['company']?>"></dd>
                <?if(isset($inquiryErrors['company'])){?>
                    <span><?=$inquiryErrors['company']?></span>
                <?}?>
        </dl>
        <dl>
            <dt><label class="write_name" for="inquiry_name">お名前※</label></dt>
            <dd><input class="write_input" id="inquiry_name" type="text" name="inquiry[name]" value="<?=$inquiry['name']?>"></dd>
            <?if(isset($inquiryErrors['name'])){?>
                <span><?= $inquiryErrors['name']?></span>
            <?}?>
        </dl>
        <dl>
            <dt><label class="write_name" for="inquiry_email">メールアドレス※</label></dt>
            <dd><input class="write_input" id="inquiry_email" type="text" name="inquiry[email]" value="<?=$inquiry['email']?>"></dd>
                <?if(isset($inquiryErrors['email'])){?>
                    <span><?=$inquiryErrors['email']?></span>
                <?}elseif(isset($inquiryErrors['emailCheck'])){?>
                    <span><?=$inquiryErrors['emailCheck']?> </span>
                <?}?>
        </dl>
        <dl>
            <dt class="write_name"></dt>
            <dd>
                <label id="write_span" for="email2">確認のため２度入力ください</label>
                <input class="write_input" id="email2" type="text" name="inquiry[emailMatch]" value="<?=$inquiry['emailMatch']?>">
            </dd>
            <?if(isset($inquiryErrors['emailMatchCheck'])){?>
                <span><?=$inquiryErrors['emailMatchCheck']?></span>
            <?}?>
        </dl>
        <dl>
            <dt><label class="write_name" for="tel">お電話番号</label></dt>
            <dd><input class="write_input" id="tel" type="text" name="inquiry[tel]" value="<?=$inquiry['tel']?>"></dd>
            <?if(isset($inquiryErrors['tel'])){?>
                <span><?=$inquiryErrors['tel']?> </span>
            <?}?>
        </dl>
        <dl>
            <dt><label class="write_name" for="inquiry_count">参加者</label></dt>
            <dd>
                <select class="write_input" id="inquiry_count" name="seminar_inquiry[reservation_count]">
                    <?for ($i=1; $i < 11; $i++) {?>
                            <option value="<?=$i?>"><?=$i?></option>
                    <?}?>
                </select>
            </dd>
            <?if(isset($seminarInquiryError['reservation_count'])){?>
                <span><?=$seminarInquiryError['reservation_count']?></span>
            <?}?>
        </dl>
        <div class="write_list write_list_button">
            <input class="write_button2 write_button2_size" type="submit" value="送信"><br>
        </div>
    </form>
<?require_once("../require/footer.php");?>
