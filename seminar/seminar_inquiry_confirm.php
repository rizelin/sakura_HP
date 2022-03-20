<?php
session_start();
require_once("../require/mysql.php");

//세미나 스케줄 신청 페이지, 성공하면 메일 발송을 위해 message로 이동

//基本セット
$inquiry = $_POST['inquiry'];
$seminarInquiry =  $_POST['seminar_inquiry'];

//post inquiry 세미나의 스케줄 신청 내용
if(isset($_POST['inquiry'])){

    $allowColumns = array(
        'inquiry' => array(
            'company' => '御社名'
            ,'name' => 'お名前'
            ,'email' => 'E-mail'
            ,'emailMatch' => 'E-mailチェック'
            ,'tel' => '電話番号'
        ),
        'seminarInquiry' => array(
            'id' => 'セミナー情報'
            ,'reservation_count' => '参加希望者'
        )
    );

    //필수 항목 必須項目
    $requiredInputs =  array(
        'inquiry' => array('company','name','email','emailMatch')
        ,'seminarInquiry' => array('id','reservation_count')
    );
    //NULL가능한 항목 NULL可能
    $nullInputs = array('tel');
    //에러 분기 종류 エラーの種類
    $errorTypes =  array(
        '1' => 'が未入力です'
        ,'2' => 'が不正な入力です'
        ,'3' => 'E-mail形式が正しくありません'
        ,'4' => 'E-mailが一致しません'
    );

    //컬럼명이 맞는가 체크 inquiry エラーチェック
    foreach ($inquiry as $key => $val) {
        if(!in_array($key, array_keys($allowColumns['inquiry']))){
            $errors['inquiry'][$key] = '2';
        }
    }
    //내용이 비었는지 체크
    foreach ($requiredInputs['inquiry'] as $key => $val) {
        if(empty($inquiry[$val])){
            $errors['inquiry'][$val] = '1';
        }
    }
    //seminar_inquiry_relation 컬럼명 다른지 체크 inquiry エラーチェック
    foreach ($seminarInquiry as $key => $val) {
        if(!in_array($key, array_keys($allowColumns['seminarInquiry']))){
            $errors['seminarInquiry'][$key] = '2';
        }
    }
    //seminar_inquiry_relation  내용이 비었는지 체크
    foreach ($requiredInputs['seminarInquiry'] as $key => $val) {
        if(empty($seminarInquiry[$val])){
            $errors['seminarInquiry'][$val] = '1';
        }
    }
    //Email유효성 검사 Emailエラーチェック
    if(!filter_var($inquiry['email'],FILTER_VALIDATE_EMAIL)){
        $errors['email']['emailCheck'] = '3';
    }
    if($inquiry['email']!=$inquiry['emailMatch']){
        $errors['emailMatch']['emailMatchCheck'] = '4';
    }

    if(isset($errors)){
        //만약 에러 일 경우
        $errorMsgs = array();
        if(isset($errors['inquiry'])){
            foreach ($errors['inquiry'] as $key => $val) {
                $tmpColumnName['inquiry'] = isset($allowColumns['inquiry'][$key])?$allowColumns['inquiry'][$key]:'不明な項目';
                $errorMsgs['inquiry'][$key] = "{$tmpColumnName['inquiry']}{$errorTypes[$val]}";
            }
        }
        if(isset($errors['seminarInquiry'])){
            foreach ($errors['seminarInquiry'] as $key => $val) {
                $tmpColumnName['seminarInquiry'] = isset($allowColumns['seminarInquiry'][$key])?$allowColumns['seminarInquiry'][$key]:'不明な項目';
                $errorMsgs['seminarInquiry'][$key] = "{$tmpColumnName['seminarInquiry']}{$errorTypes[$val]}";
            }
        }
        if(isset($errors['email']['emailCheck'])){
            $errorMsgs['inquiry']['emailCheck'] = "{$allowColumns['inquiry']['email']}{$errorTypes[3]}";
        }
        if(isset($errors['emailMatch']['emailMatchCheck'])){
            $errorMsgs['inquiry']['emailMatchCheck'] = "{$allowColumns['inquiry']['emailMatch']}{$errorTypes[4]}";
        }
    } else {
        $sqlFlg = false;
        $values = array();
        $columns = array();
        foreach($allowColumns['inquiry'] as $key => $val){
            if($key != 'emailMatch'){
                $columns[] = "`{$key}`";
                //내용이 없을 경우 NULL을 입력한다(tel한정)
                if(empty($inquiry[$key]) && in_array($key, $nullInputs)){
                    $values[] = "NULL";
                } else {
                    //그외의 내용은 escape처리를 한다
                    $values[] = "'".$_link->real_escape_string($inquiry[$key])."'";
                }
            }
        }
        $columns = implode(',',$columns);
        $values = implode(',',$values);

        //3개가 차례로 다 성공해야지 true가 들어가며 하나라도 실패시에 롤백을 한다.
        $sql = "INSERT INTO `inquiry` ($columns,`registration_datetime`) VALUES ({$values},now())";
        if($res = $_link->query($sql)){
            $inquiryId = $_link->insert_id;
            $inquiryValues = "'".$_link->real_escape_string($seminarInquiry['reservation_count'])."'";
            $sql = "INSERT INTO `seminar_inquiry` (`inquiry_id`,`reservation_count`) VALUES ('{$inquiryId}',{$inquiryValues})";
            if($res = $_link->query($sql)){
                $seminarInquiryId = $_link->insert_id;
                $sql = "INSERT INTO `seminar_inquiry_relation` (`seminar_schedule_id`,`seminar_inquiry_id`) VALUES ('{$seminarInquiry['id']}','{$seminarInquiryId}')";
                if($res = $_link->query($sql)){
                    $_link->commit();
                    $sqlFlg = true;
                } else {
                    $_link->rollback();
                }
            }
        }
    }

    if($sqlFlg){
        $_link->commit();
        $_SESSION['inquiry'] = $_POST['inquiry'];
        $_SESSION['seminarInquiry'] = $_POST['seminar_inquiry'];
        header("location:./seminar_inquiry_confirm_message.php");
        exit();
    } else {
        $_link->rollback();
        $_SESSION['errorMsgs']['inquiry'] = $errorMsgs['inquiry'];
        $_SESSION['errorMsgs']['seminarInquiry'] = $errorMsgs['seminarInquiry'];
        $_SESSION['inquiry'] = $_POST['inquiry'];
        $_SESSION['seminarInquiry'] = $_POST['seminar_inquiry'];
        header("location:./seminar_inquiry_write.php?id=".$_POST['id']);
        exit();
    }
} else {
    header("location:./seminar_board.php");
    exit();
}

?>
