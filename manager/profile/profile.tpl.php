<!-- header -->
<?require_once("../require/header.php");?>
<div id="title_name">
    <h1>会社概要</h1>
</div>
<?= isset($confirmMsg)? "<p id='notice_message'>$confirmMsg</p>":'';?>
<form class="select" action="./profile.php" method="get">
  <select class="profile_select" name="profile_id">
      <option selected value="22">会社概要<option>
      <?for($i=0 ; $i < $count ; $i++){?>
          <option value="<?=$fixedArray[$i]['id']?>"<?=($fixedArray[$i]['id']==$fixedId) ? "selected" :''?>><?=$fixedArray[$i]['title']?></option>
      <?}?>
  </select>
  <input type="submit" name="" value="検索">
</form>

<div class="profile_main_border">
    <?=$fixed['text']?>
</div>
<input type="button" class="" onclick="location='./fixed.php?fixed_id=<?=$fixedId?>'" value="修正">
<?require_once("../require/footer.php");?>
