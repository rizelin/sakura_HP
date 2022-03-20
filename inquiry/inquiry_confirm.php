<?php
session_start();
require_once("../require/mysql.php");
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
//error処理  1.必要事項確認 2.不正な項目 3.email２つの情報合ってるか確認

$allowColumns = array(
  'company' => '会社名',
  'name' => 'お名前',
  'email' => 'メールアドレス',
  'emailMatch' => '確認用メールアドレス',
  'tel' => 'お電話番号',
  'zip_code' => '郵便番号',
  'prefecture' => '都道府県',
  'address1' => '市・区・郡・町',
  'address2' => '番地・建物名等',
  'text' => '本文'
);
$requiredInputs = array('company','name','email','emailMatch','tel','prefecture','text');
$errorTypes = array(
  '1' => 'が入力されていません。' ,
  '2' => 'が不正に入力されました。' ,
  '3' => 'メールアドレスと確認用メールアドレスが一致しません。'
);

//inquiry.phpのerror処理
if (isset($_POST['inquiry'])) {
$inquiry = $_POST['inquiry'];
$_SESSION['inquiry'] = $inquiry;
$_SESSION['emailBody'] = array();

    foreach ($requiredInputs as $key => $value) {
        if (empty($inquiry[$value])) {
          $errors[$value] = '1';
        }
    }
    foreach ($inquiry as $key => $value) {
        if (!in_array($key,array_keys($allowColumns))) {
          $errors[$key] = '2';
        }
    }
    if ($inquiry['email']!==$inquiry['emailMatch']) {
        $errors['emailConfirm'] = '3';
    }

    if (isset($errors)) {
        $errorMsgs = array();
        foreach ($errors as $key => $value) {
            $errorMsgs[$key] = "{$allowColumns[$key]}{$errorTypes[$value]}";
        }
        $_SESSION['errors'] = $errorMsgs;
        header("location:./inquiry_write.php");
        exit();
    }else {
        //地域prefecture
        foreach ($prefectures as $key => $value) {
            if ($key == $inquiry['prefecture']) {
                $prefecture = $value;
                $_SESSION['emailBody']['prefecture2'] = $prefecture;
            }
        }
    }

}elseif (isset($_POST['confirm'])) {
$inquiry = $_SESSION['inquiry'];
$sqlFlg = FALSE;
$columns = array();
$values = array();

    //inquiryテーブルに入れる情報準備
    foreach ($inquiry as $key => $value) {
        if (!empty($value) && $key!='emailMatch') {
            $columns[] = "`$key`";
            $values[] = "\"$value\"";
        }
    }
    $columns = implode(",",$columns);
    $values = implode(",",$values);

    $sql = "INSERT INTO `inquiry`($columns,`registration_datetime`) VALUES ($values,NULL)";
    if ($res = $_link->query($sql)) {
        if ($_link->affected_rows == 1) {
            $sqlFlg = TRUE;
        }
    }

    if ($sqlFlg) {
        $_link->commit();
        $_SESSION['confirmMsg'] ="お問い合わせいただきありがとうございます。";
        foreach ($_SESSION['inquiry'] as $key => $value) {
            $_SESSION['emailBody'][$key] = $value;
        }
        unset($_SESSION['inquiry']);
    }else {
        $_link->rollback();
        $_SESSION['confirmMsg'] = "お問い合わせ失敗しました。";
        unset($_SESSION['emailBody']);
    }
    header("location:./inquiry_confirm_message.php");
    exit();

}else {
    header("location:./inquiry_write.php");
    exit();
}

include_once("./inquiry_confirm.tpl.php");
?>
