<!-- header -->
<?require_once("./header.php");?>
<div id="title_name">
    <h1>MediaLibrary</h1>
</div>

<?=isset($resultMsg)? "<p id='notice_message'>$resultMsg</p>":''?>
<div class="manager_media">
    <form class="media_button_form" action="./media.php" enctype="multipart/form-data" method="POST">
        <label for="file">新規追加</label>
        <input id="file" type="file" name="media">
        <input class="write_button2" type="submit" value="追加">
    </form>

<form action="./media.php" method="POST">
<table class="table_board media_list">
    <?if (!empty($imgArrs)) {?>
        <tr class="media_submit">
            <th colspan="3"></th>
            <th><input class="write_button2" type="submit" value="削除"></th>
        </tr>
        <tr>
            <th>削除</th>
            <th>イメージ</th>
            <th>ファイル名</th>
            <th>URL</th>
        </tr>
        <?foreach ($imgArrs as $key => $value) {?>
            <tr>
                <td><input type="checkbox" id="<?=$value?>" name="delete[]" value="<?=$value?>"></td>
                <td><label for="<?=$value?>"><img src="/common/media/<?=$value?>" width="150px"></label></td>
                <td><?=$value?></td>
                <td><input type="text" value="http://minho.wj.am/common/media/<?=$value?>"></td>
            </tr>
        <?}?>
    <?} else {?>
    <tr>
        <td>メディアファイルがありません。</td>
    </tr>
    <?}?>
</table>
</form>

</div>
<?require_once("../../require/footer.php");?>
