<?php
session_start();
require_once("../require/menu.php");
require_once("../require/mysql.php");

$bodyContents = $_SESSION['emailBody'];
unset($_SESSION['emailBody']);
$columns = array(
                      'list' => 'ご希望の商品選択' ,
                      'company' => '会社名',
                      'name' => 'お名前',
                      'email' => 'メールアドレス',
                      'tel' => 'お電話番号',
                      'zip_code' => 'ご住所',
                      'text' => '本文'
                    );
//カラム判断して内容保存
foreach ($columns as $key => $value) {
    if ($key == 'email') {
        $to = $bodyContents[$key];
    }
    if ($key == 'zip_code') {
        $inputBody[$key] = "〒{$bodyContents[$key]}\n{$bodyContents['prefecture2']}{$bodyContents['address1']}{$bodyContents['address2']}";
    }else {
        $inputBody[$key] = $bodyContents[$key];
    }
}
//bodyに入れる情報を文字列で保存
foreach ($inputBody as $key => $value) {
    $bodyText[] = "$columns[$key]\n $value\n";
}
$bodyText = implode("\n",$bodyText);

$subject = "お見積りご依頼のお知らせ";
$body = "ご依頼いただきありがとうございます。ご依頼を下記のとおり受け付けいたしました。\n\n".$bodyText;

include_once("../require/email.php");
mailSend($to,$subject,$body);
$confirmMsg = implode("<br>",array($_SESSION['confirmMsg'],$_SESSION['emailConfirmMsg']));
unset($_SESSION['confirmMsg'],$_SESSION['emailConfirmMsg']);

include_once("./lineup_inquiry_confirm_message.tpl.php");
?>
