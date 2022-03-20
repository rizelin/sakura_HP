<?php

function mailSend($to,$subject,$body){
    $errorFlg = false;
    if(isset($to,$subject,$body)){
        $from = "wb.eunhye18@gmail.com";
        $bcc = array($from);
      //内部エンコーディング設定
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
      //送信者のアドレスを設定
        $from = mb_encode_mimeheader($from,"UTF-8","iso-2022-jp");
        $header = "From: {$from} \n";
      //BCCの値があればセットする
        $header .= is_null($bcc) ? "" : "Bcc: ".implode(',',$bcc)." \n";
      //メールの文字コードの記述
        $header .= "Content-Type: text/plain; charset=iso-2022-jp \n";
        $header .= "Content-Transfer-Encoding: 7bit \n";
      //送信後にエラーが発生した場合のエラー通知先メールアドレス
        $fParam = "-f {$from}";
        $errorFlg = mb_send_mail($to,$subject,$body,$header,$fParam);
    }
    if ($errorFlg) {
        $_SESSION['emailConfirmMsg'] ="確認用メールをお送りました。";
    }else {
        header("location:./main.php");
        exit();
    }
}
 ?>
