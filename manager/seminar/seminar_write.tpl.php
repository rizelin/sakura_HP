<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name">
    <h1>セミナー追加</h1>
</div>
    <form class="write_form" action="./seminar_update.php" method="post" enctype="multipart/form-data">
        <dl>
            <input type="hidden" name="id" value="<?=$_GET['id']?>">
            <dt><label class="write_name" for="title">タイトル</label></dt>
            <dd>
                <input class="write_input" id="title" type="text" name="input[title]" value="<?=$seminar['semi_title']?>">
            </dd>
            <?if(isset($errorMsgs['seminar']['title'])){?>
                <span><?=$errorMsgs['seminar']['title'];?> </span>
            <?}?>
        </dl>
        <dl>
            <dt><label class="write_name" for="caption">見出し</label></dt>
            <dd>
                <textarea class="write_sub_text" id="caption" name="input[caption]" rows="4" cols="20"><?=$seminar['caption']?></textarea>
            </dd>
            <?if(isset($errorMsgs['seminar']['caption'])){?>
                <span><?=$errorMsgs['seminar']['caption'];?></span>
            <?}?>
        </dl>
        <dl>
            <dt><label class="write_name" for="img">見出しイメージ</label></dt>
            <dd>
                <input id="img" type="file" name="up_img">
                <?if(!empty($seminar['img'])){?>
                    <input type="hidden" name="input[img]" value="<?=$seminar['img']?>"><br>
                    <img src="/common/img/seminar/<?=$seminar['img']?>" width="40%" >
                    <input type="checkbox" name="img_delete" id="img_delete" value="1">
                    <label for="img_delete">イメージ削除</label>
                <?}?>
            </dd>
        </dl>
        <dl>
          <dt><label class="write_name sub_text textarea_name" for="text">本文</label></dt>
          <dd><textarea class="write_text" id="text" name="input[text]" rows="4" cols="20"><?=$seminar['text']?></textarea></dd>
            <?if(isset($errorMsgs['seminar']['text'])){?>
                  <span><?=$errorMsgs['seminar']['text'];?></span>
            <?}?>
        </dl>
        <?if(!empty($_GET['id'])){?>
        <dl>
            <dt><label class="write_name" for="registration_datetime">作成日付</label></dt>
            <dd><div class="write_date" id="registration_datetime"><?=$seminar['registration_datetime']?></div></dd>
        </dl>
        <dl>
            <dt><label class="write_name" for="update_datetime">修正日付</label></dt>
            <dd><div class="write_date" id="update_datetime"><?=$seminar['update_datetime']?></div></dd>
        </dl>
        <?}?>
        <dl>
            <dt><label class="write_name" for="public_datetime">公開日付</label></dt>
            <dd>
                <input class="write_input date_size" id="public_datetime" type="date" name="seminar_datetime[public_date]" value="<?=$seminar['public_datetime'][0]?>">
                <input class="write_input date_size" type="time" name="seminar_datetime[public_time]" value="<?=$seminar['public_datetime'][1]?>">
            </dd>
            <?if(isset($errorMsgs['seminar']['public_datetime'])){?>
                  <span><?=$errorMsgs['seminar']['public_datetime'];?> </span>
            <?}?>
        </dl>
        <dl>
            <dt><label class="write_name" for="limit_datetime">制限日付</label></dt>
            <dd>
                <input class="write_input date_size" id="limit_datetime" type="date" name="seminar_datetime[limit_date]" value="<?=$seminar['limit_datetime'][0]?>">
                <input class="write_input date_size" type="time" name="seminar_datetime[limit_time]" value="<?=$seminar['limit_datetime'][1]?>">
            </dd>
        </dl>
        <dl>
            <dt><label class="write_name" for="status">公開範囲</label></dt>
            <dd>
                <select class="write_input" id="status" name="input[status]">
                    <option value="1" <?=($seminar['status']==1)? "selected":''?>>公開</option>
                    <option value="2" <?=($seminar['status']==2)? "selected":''?>>非公開</option>
                    <?if(!empty($_GET['id'])){?>
                        <option value="3" <?=($seminar['status']==3)? "selected":''?>>削除</option>
                    <?}?><br>
                </select>
            </dd>
            <?if(isset($errorMsgs['seminar']['status'])){?>
                <span><?=$errorMsgs['status'];?></span>
            <?}?>
        </dl>
        <?if(isset($count)){?>
            <?for($i = 0; $i < $count; $i++){?>
                <dl>
                    <input type="hidden" name="schedule_id[]" value="<?if(isset($schedule[$i]['sche_id'])){?><?=$schedule[$i]['sche_id']?><?}?>">
                    <dt><h3 class="write_name sub_text">スケジュール<h3></dt>
                </dl>
                <dl>
                    <dt><label class="write_name" for="schedule_title">タイトル</label></dt>
                    <dd>
                        <input id="title" type="text" name="schedule[title][]" value="<?if(isset($schedule[$i]['sche_title'])){?><?=$schedule[$i]['sche_title']?><?}?>">
                    </dd>
                    <?if(isset($errorMsgs['schedule']['title'][$i])){?>
                        <span><?=$errorMsgs['schedule']['title'][$i];?></span>
                    <?}?>
                </dl>
                <dl>
                    <dt><label class="write_name write_text" for="schedule_address">開催地</label></dt>
                    <dd>
                        <textarea class="write_address" id="schedule_address" name="schedule[address][]">
                            <?if(isset($schedule[$i]['address'])){?>
                                <?=$schedule[$i]['address']?>
                            <?}?>
                        </textarea>
                    </dd>
                    <?if(isset($errorMsgs['schedule']['address'][$i])){?>
                        <span><?=$errorMsgs['schedule']['address'][$i];?></span>
                    <?}?>
                </dl>
                <dl>
                    <dt><label class="write_name" for="schedule_entry_fee">入場料</label></dt>
                    <dd>
                        <input class="write_input" id="schedule_entry_fee" type="text" name="schedule[entry_fee][]" value="<?if(isset($schedule[$i]['entry_fee'])){?><?=$schedule[$i]['entry_fee']?><?}?>">
                    </dd>
                    <?if(isset($errorMsgs['schedule']['entry_fee'][$i])){?>
                          <span><?=$errorMsgs['schedule']['entry_fee'][$i];?> </span>
                    <?}?>
                </dl>
                <dl>
                    <dt><label class="write_name" for="start_time">日付日時</label></dt>
                    <dd>
                        <input class="write_input date_size" type="date" name="schedule_datetime[start_date][]" value="<?=$schedule[$i]['start_time'][0]?>">
                        <input class="write_input date_size" type="time" name="schedule_datetime[start_time][]" value="<?=$schedule[$i]['start_time'][1]?>">
                        ~ <input class="write_input date_size" type="time" name="schedule_datetime[end_time][]" value="<?=$schedule[$i]['end_time'][1]?>">
                    </dd>
                    <?if(isset($errorMsgs['schedule']['start_time'][$i])){?>
                        <span><?=$errorMsgs['schedule']['start_time'][$i];?></span>
                    <?}elseif(isset($errorMsgs['schedule']['end_time'][$i])){?>
                        <span><?=$errorMsgs['schedule']['end_time'][$i];?> </span>
                    <?}?>
                </dl>
                <dl>
                    <dt><label class="write_name" for="schdule_status">公開範囲</label></dt>
                    <dd>
                        <select class="status" name="schedule[status][]">
                            <option value="1" <?=($schedule[$i]['sche_status']==1)? "selected":''?>>公開</option>
                            <option value="2" <?=($schedule[$i]['sche_status']==2)? "selected":''?>>非公開</option>
                            <option value="3" <?=($schedule[$i]['sche_status']==3)? "selected":''?>>削除</option>
                        </select>
                    </dd>
                </dl>
                <?}
            }?>
            <!-- id=parah에서 추가함 -->
            <div id="parah"></div>
            <dl class="fixed_button">
                <input class="" type="button" value="スケジュール追加" onclick="addInput();" />
                <input class="" type="button" value="スケジュール削除" onclick="deleteInput();"/>
                <input class="" type="submit" value="登録">
            </dl>
    </form>
    <?if(!empty($count)){?>
        <a href="./seminar_inquiry_write.php?id=<?=$_GET['id']?>">セミナー申込み</a>
    <?}?>
<?require_once("../require/footer.php");?>
