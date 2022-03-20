<?php
//DBの接続
require_once("../require/mysql.php");
//ログイン
require_once("../require/login.php");

if(isset($_SESSION['inquiry'])){
    $inquiry = $_SESSION['inquiry'];
    $seminarInquiry = $_SESSION['seminarInquiry'];
    unset($_SESSION['inquiry'], $_SESSION['seminarInquiry']);

    $columns = array(
        'inquiry' => array(
            'company' => '御社名 : '
            ,'name' => 'お名前 : '
            ,'email' => 'メールアドレス : '
            ,'tel'  => 'お電話番法 : '
        ),
        'seminar_inquiry' => array(
            'reservation_count' => '参加希望者 : '
        )
    );

    $bodyText = array();
    foreach($columns['inquiry'] as $key => $val){
        $bodyText[] = "{$val}{$inquiry[$key]} \n";
    }
    foreach($columns['seminar_inquiry'] as $key => $val){
        $bodyText[] = "{$val}{$seminarInquiry[$key]} 名様\n";
    }



    $bodyText = implode("\n",$bodyText);

    $to = $inquiry['email'];

    $subject = "御申し込みありがとうございます。";
    $body = "申込みの情報と日付です\nご確認お願い致します\n\n".$bodyText ;

    include_once("../require/email.php");
    mailSend($to,$subject,$body);
    $confirmMsg = "ご依頼いただきありがとうございます{$_SESSION['emailConfirmMsg']}";
    unset($_SESSION['emailConfirmMsg']);
    include_once("./seminar_inquiry_confirm_message.tpl.php");

} else {
    header("location:./seminar_board.php");
    exit();
}

?>
