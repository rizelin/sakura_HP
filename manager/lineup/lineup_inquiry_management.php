<?php
//ini_set('display_errors',1);
require_once("../require/mysql.php");
require_once("../require/login.php");
$prefectures = array(
    1 => '北海道',2 => '青森県',3 => '岩手県',4 => '宮城県',5 => '秋田県',
    6 => '山形県',7 => '福島県',8 => '茨城県',9 => '栃木県',10 => '群馬県',
    11 => '埼玉県',12 => '千葉県',13 => '東京都',14 => '神奈川県',15 => '新潟県',
    16 => '富山県',17 => '石川県',18 => '福井県',19 => '山梨県',20 => '長野県',
    21 => '岐阜県',22 => '静岡県',23 => '愛知県',24 => '三重県',25 => '滋賀県',
    26 => '京都府',27 => '大阪府',28 => '兵庫県',29 => '奈良県',30 => '和歌山県',
    31 => '鳥取県',32 => '島根県',33 => '岡山県',34 => '広島県',35 => '山口県',
    36 => '徳島県',37 => '香川県',38 => '愛媛県',39 => '高知県',40 => '福岡県',
    41 => '佐賀県',42 => '長崎県',43 => '熊本県',44 => '大分県',45 => '宮崎県',
    46 => '鹿児島県',47 =>'沖縄県'
);

 if (isset($_GET['id'])) {
   $lineupInquiryId = $_GET['id'];
   $sql= "SELECT a.`id`, c.`id` as inquiry_id, GROUP_CONCAT(d.`name`)as lineup_name, c.`registration_datetime`, c.`response_datetime`, c.`company`, c.`name`, c.`text`, c.`email`, c.`tel`, c.`zip_code`, c.`prefecture`, c.`address1`, c.`address2`
            FROM `lineup_inquiry` as a
      INNER JOIN `lineup_inquiry_relation` as b
              ON  a.`id` = b.`lineup_inquiry_id`
      RIGHT JOIN `inquiry` as c
              ON  a.`inquiry_id` = c.`id`
      INNER JOIN `lineup` as d
              ON  b.`lineup_id` = d.`id`
           WHERE  a.`id` = {$lineupInquiryId}
          ";
    if ($res = $_link->query($sql)) {
        if ($res->num_rows != 0) {
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
              $lineupInquiryList = $row;
            }
        }

        //都道府県
        foreach ($prefectures as $key => $value) {
          if ($key == $lineupInquiryList['prefecture']) {
            $prefecture = $value;
          }
        }
        //商品リスト
        $lineupName = implode('<br>',explode(",",$lineupInquiryList['lineup_name']));
    }

 }elseif (isset($_POST['confirm_checked'])) {
   $sqlFlg = FALSE;
   $inquiryId = $_POST['confirm_checked'];
   $sql = "UPDATE `inquiry`
              SET `response_datetime` = NOW()
            WHERE `id` = {$inquiryId}";
       if ($res = $_link->query($sql)) {
           if ($_link->affected_rows == 1) {
              $sqlFlg = TRUE;
           }
       }
       if ($sqlFlg) {
         $_link->commit();
         $_SESSION['confirmMsg'] = "応答チェック処理しました。";
       }else {
         $_link->rollback();
         $_SESSION['confirmMsg'] = "応答チェック処理が失敗しました。";
       }
       header("location:./lineup_inquiry_management_board.php");
       exit();
  }else {
      header("location:./lineup_inquiry_management_board.php");
      exit();
  }

include_once("./lineup_inquiry_management.tpl.php");
?>
