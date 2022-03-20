<?php
// ini_set('display_errors',1);
//DBの接続
require_once("../require/mysql.php");
//ログイン
require_once("../require/login.php");

//基本セット
$input = $_POST['input'];
$schedule = $_POST['schedule'];
$schedule_id = $_POST['schedule_id'];

//datetime
$seminar_datetime = $_POST['seminar_datetime'];
$input['public_datetime'] = $seminar_datetime['public_date'].'T'.$seminar_datetime['public_time'];
$input['limit_datetime'] = $seminar_datetime['limit_date'].'T'.$seminar_datetime['limit_time'];
$schedule_datetime = $_POST['schedule_datetime'];
$date_count = count($schedule_datetime['start_date']);
for ($i=0; $i < $date_count; $i++) {
    $schedule['start_time'][$i] = $schedule_datetime['start_date'][$i].'T'.$schedule_datetime['start_time'][$i];
    $schedule['end_time'][$i] = $schedule_datetime['start_date'][$i].'T'.$schedule_datetime['end_time'][$i];
}
//스케줄의 배열 수를 구한다
$count = count($schedule_id);
//url로부터 직접 접속시 board로 팅겨낸다
if(empty($_POST['input'])){
    header("location:./seminar_board.php");
    exit();
}
//갱신 가능한 칼럼 세미나
$allowColumns = array(
    'seminar' => array(
        'title'             => 'タイトル'
        , 'caption'         => '見出し'
        , 'img'             => 'イメージ'
        , 'text'            => '本文'
        , 'public_datetime' => '公開日付'
        , 'limit_datetime'  => '制限日付'
        , 'status'          => '公開状態'
    ),
    'schedule' => array(
        'title'           => 'タイトル'
        , 'address'       => '開催地'
        , 'entry_fee'     => '入場料'
        , 'start_time'    => '始まる時間'
        , 'end_time'      => '終わる時間'
        , 'status'        => '公開状態'
    )
);
//세미나 必須項目가능한 항목+에러 종류
$requiredInputs = array(
    'seminar'  => array('title', 'caption', 'text', 'public_datetime', 'status')
    , 'schedule' => array('title', 'address', 'entry_fee', 'start_time', 'end_time', 'status')
);
//NULL可能な目録
$nullInputs = array('seminar'  => array('limit_datetime'));
//エラーの種類
$errorTypes = array(
    '1' => 'が未入力です'
    , '2' => 'が不正な入力です'
    , '3' => '始まる時間より終わる時間が早いです'
);
//세미나 에러를 체크
foreach ($input as $key => $val){
    if(!in_array($key, array_keys($allowColumns['seminar']))){
        $errors['seminar'][$key] = '2';
    }
}
foreach ($requiredInputs['seminar'] as $key => $val){
    if(empty($input[$val])){
        $errors['seminar'][$val] = '1';
    }
}
//세미나 이미지 입력
if($_FILES['img']['error']==1){
    $errors['seminar']['img'] = '3';
}
//스케줄의 에러를 체크   //for를 스케줄의 배열 값 만큼 반복
for ($i=0; $i < $count; $i++) {
    foreach ($schedule[$val][$i] as $key => $val){
        if(!in_array($key, array_keys($allowColumns['schedule']))){
            $errors['schedule'][$key][$i] = '2';
        }
    }
    foreach($requiredInputs['schedule'] as $key => $val){
        if(empty($schedule[$val][$i])){
            $errors['schedule'][$val][$i] = '1';
        }
    }
    //スケジュールの時間があってるのか確認
    if($schedule['start_time'][$i] > $schedule['end_time'][$i]){
        $errors['schedule']['start_time'][$i] = '3';
    }
}


//세미나 또는 스케줄에 에러가 set되어 있다면:에러＆없다면:정상
if(isset($errors)){
    //세미나 에러쎄트
    if(isset($errors['seminar'])){
        $errorMsgs = array();
        foreach($errors['seminar'] as $key => $val){
            $tmpColumnName['seminar'] = isset($allowColumns['seminar'][$key]) ? $allowColumns['seminar'][$key] : '不明な項目';
            $errorMsgs['seminar'][$key] = "{$tmpColumnName['seminar']}{$errorTypes[$val]}";
        }
    }
    //스케줄 에러쎄트
    if(isset($errors['schedule'])){
        foreach ($errors['schedule'] as $key => $val) {
            foreach ($val as $key2 => $val2) {
                $tmpColumuName['schedule'] = isset($allowColumns['schedule'][$key]) ? $allowColumns['schedule'][$key] : '不明な項目';
                $errorMsgs['schedule'][$key][$key2] = "{$tmpColumuName['schedule']}{$errorTypes[$val2]}";
            }
        }
    }
    if(!isset($errors)){
        $_link->rollback();
    } else {
        //에러 내용 쎄트
        $_SESSION['errorMsgs']['seminar'] = $errorMsgs['seminar'];
        $_SESSION['errorMsgs']['schedule'] = $errorMsgs['schedule'];
    }
    $_SESSION['seminar'] = $input;
    foreach ($schedule as $key => $val) {
        foreach ($val as $key2 => $val2) {
            $_SESSION['schedule'][$key2][$key] = $val2;
        }
    }
    foreach ($schedule_id as $key => $val) {
        $_SESSION['schedule'][$key]['sche_id'] = $val;
    }
    header('location:./seminar_write?id='.$_POST['id']);
    exit();

} else {
    //에러가 없을 때는 sql용데이터를 만든다
    $sqlFlg = array();
    $values['values'] = array();
    $columns['seminar'] = array();
    $sqlFlg['seminar'] = false;
    $sqlFlg['schedule'] = false;
    $input['public_datetime'] = str_replace("T", " ",$input['public_datetime']);
    $input['limit_datetime'] = str_replace("T", " ",$input['limit_datetime']);

    //fileイメージ処理
    if(!empty($_FILES['up_img']['name']) || isset($_POST['img_delete'])){
        $saveDir = "/home/.sites/45/site47/web/common/img/seminar/";
        //登録
        if(!empty($_FILES['up_img']['name'])){
            $ext = pathinfo($_FILES['up_img']['name'], PATHINFO_EXTENSION);
            $fileName = date("YmdHis").".".$ext;
            if (is_uploaded_file($_FILES['up_img']['tmp_name'])){
                if(move_uploaded_file($_FILES['up_img']['tmp_name'],$saveDir.$fileName)){
                    $input['img'] = $fileName;
                }
            }
        //削除 img name있거나 delete가 셋트되 있다면
        } elseif($_POST['img_delete'] == 1){
            @unlink($saveDir.$input['img']);
            $input['img'] = '';
        }
    }

    //세미나 컬럼이름을 대입하고 날짜 형식을 바꿔준다
    foreach($allowColumns['seminar'] as $key => $val){
        if(!empty($_POST['id'])){
            //수정 업데이트
            if(empty($input[$key]) && in_array($key, $nullInputs['seminar'])){
                $values['seminar'][] = "`{$key}` = NULL";
            } else {
                $values['seminar'][] = "`{$key}` = '".$_link->real_escape_string($input[$key])."'";
            }
        } else {
            //empt가 없다면 인썰트 신규
            $columns['seminar'][] ="`{$key}`";
            if(empty($input[$key]) && in_array($key, $nullInputs['seminar'])){
                $values['seminar'][] = "NULL";
            } else {
                $values['seminar'][] = "'".$_link->real_escape_string($input[$key])."'";
            }
        }
    }
    $seminar_columns = implode(',',$columns['seminar']);
    $seminar_values = implode(',',$values['seminar']);

    //sql문 작성
    if(!empty($_POST['id'])){
        $sql = "UPDATE `seminar` SET {$seminar_values} WHERE `id` = '{$_POST['id']}'";
        if($res = $_link->query($sql)){
            $sqlFlg['seminar'] = true;
        }
    } else {
        $sql = "INSERT INTO `seminar` ({$seminar_columns},`registration_datetime`,`manager_id`)
        VALUES ({$seminar_values}, now(), '{$user['id']}')";
        if($res = $_link->query($sql)){
            //스케줄
            $seminar_id = $_link->insert_id;
            if($_link->affected_rows == 1){
                $sqlFlg['seminar'] = true;
            }
        }
    }
    //세미나만 있고 스케줄이 없을 시
    if($sqlFlg['seminar']){
        if($count == 0){
            $sqlFlg['schedule'] = true;
        } else {
            //스케줄 에스캡처리
            for($i=0; $i < $count; $i++){
                $values['schedule'] = array();
                $columns['schedule'] = array();
                foreach ($allowColumns['schedule'] as $key => $val) {
                    if (!empty($schedule_id[$i])) {
                        //empty가 있다면 업데이트 수정
                        if(empty($schedule[$key]) && in_array($key, $nullInputs['schedule'])){
                            $values['schedule'][] = "`{$key}` = NULL";
                        } else {
                            if($key == 'end_time'){
                                $tmpVal = str_replace("T", " ",$schedule[$key][$i]);
                                $values['schedule'][] = "`{$key}` = '".$_link->real_escape_string($tmpVal)."'";
                            } else {
                                $values['schedule'][] = "`{$key}` = '".$_link->real_escape_string($schedule[$key][$i])."'";
                            }
                        }
                    } else {
                    //empty가 없다면 인썰트 신규
                        $columns['schedule'][] = "`{$key}`";
                            if(empty($schedule[$key]) && in_array($key, $nullInputs['schedule'])){
                                $values['schedule'][] = "NULL";
                            } else {
                                if($key == 'end_time'){
                                    $tmpVal = str_replace("T", " ",$schedule[$key][$i]);
                                    $values['schedule'][] = "'".$_link->real_escape_string($tmpVal)."'";
                                } else {
                                    $values['schedule'][] = "'".$_link->real_escape_string($schedule[$key][$i])."'";
                                }
                            }
                    }
                }

                $schedule_columns = implode(',',$columns['schedule']);
                $schedule_values = implode(',',$values['schedule']);

                if(!empty($schedule_id[$i])){
                    $sql = "UPDATE `seminar_schedule`
                    SET {$schedule_values}
                    WHERE `id` = '{$schedule_id[$i]}'";
                    if($res = $_link->query($sql)){
                        //sql성공시 ++
                        $result = $result+1;
                        //배열값과 sql성공 횟수가 동일하다면 true
                        if($result == $count){
                            $sqlFlg['schedule'] = true;
                        }
                    }
                } else {
                    $seminar_id = isset($seminar_id) ? $seminar_id : $_POST['id'];
                    if(!empty($seminar_id)){
                        $sql = "INSERT INTO `seminar_schedule` ({$schedule_columns}, `seminar_id`)
                        VALUES ({$schedule_values}, '{$seminar_id}')";
                        if($res = $_link->query($sql)){
                            $sqlFlg['schedule'] = true;
                        }
                    }
                }
            }
        }
    }
    if($sqlFlg['seminar'] && $sqlFlg['schedule']){
        //세미나&스케줄 성공
        $input['status']=='3'?  $_SESSION['confirmMsg'] ="記事削除完了しました。" : $_SESSION['confirmMsg'] ="記事登録完了しました。";
        $_link->commit();
        header("location:./seminar_board.php");
        exit();
    }
}




?>
