<?php
// ini_set('display_errors',1);

//DBの接続
require_once("../require/mysql.php");
//ログイン
require_once("../require/login.php");



//세미나+스케줄
if(isset($_GET['id'])){
    //sql 문구 컬럼의 이름의 한정해서 ``를 붙이며 그 외는 as로 변경한 이름등은 붙이지 않는다.
    $sql = "SELECT
        a.`id` as semi_id
        , a.`title` as semi_title
        , a.`caption`
        , a.`img`
        , a.`text`
        , a.`registration_datetime`
        , a.`public_datetime`
        , a.`update_datetime`
        , a.`limit_datetime`
        , a.`status`
    FROM `seminar` as a
    WHERE a.`id` = {$_GET['id']}";
    // 가장 빠른 날짜 순(ASC)으로 나열하여 사용자에게 보기 편하게 한다   최근날짜순DESC
    // 세미나 이름 등에는 as를 사용하지 않아도 된다.
    if($res = $_link->query($sql)){
        //세미나를 배열
        while($row = $res->fetch_array(MYSQLI_ASSOC)){
            //배열에 넣기전에 날짜 타입을 변경한다    datetime-local한정：날짜와 시간 사이에 T가 들어감
            $row['public_datetime'] = str_replace(' ','T',$row['public_datetime']);
            $row['limit_datetime'] = str_replace(' ','T',$row['limit_datetime']);
            $row['public_datetime'] = explode('T',$row['public_datetime']);
            $row['limit_datetime'] = explode('T',$row['limit_datetime']);
            //배열 []상태에 $row를 넣는다　배열은[]상태에만 무언가를 대입가능하다
            $seminar = $row;

        }
    }

    $sql = "SELECT
        b.`id` as sche_id
        , b.`seminar_id`
        , b.`title` as sche_title
        , b.`address`
        , b.`start_time`
        , b.`end_time`
        , b.`entry_fee`
        , b.`status` as sche_status
    FROM `seminar_schedule` as b
    WHERE b.`seminar_id` = {$_GET['id']}
    AND   b.`status` IN (1, 2)
    ORDER BY b.`start_time` ASC";
    // 가장 빠른 날짜 순(ASC)으로 나열하여 사용자에게 보기 편하게 한다   최근날짜순DESC
    // 세미나 이름 등에는 as를 사용하지 않아도 된다.
    if($res = $_link->query($sql)){
        //세미나를 배열
        $schedule = array();
        while($row = $res->fetch_array(MYSQLI_ASSOC)){
            //배열에 넣기전에 날짜 타입을 변경한다    datetime-local한정：날짜와 시간 사이에 T가 들어감
            $row['start_time'] = str_replace(' ','T',$row['start_time']);
            $row['end_time'] = str_replace(' ','T',$row['end_time']);
            $row['start_time'] = explode('T',$row['start_time']);
            $row['end_time'] = explode('T',$row['end_time']);
            //배열 []상태에 $row를 넣는다　배열은[]상태에만 무언가를 대입가능하다
            $schedule[] = $row;
        }
    }
}

//실패시
if (isset($_SESSION['errorMsgs'])) {
    //配列を作る
    $errorMsgs = array();
    //エラーメッセージ
    $errorMsgs['seminar'] = $_SESSION['errorMsgs']['seminar'];
    $errorMsgs['schedule'] = $_SESSION['errorMsgs']['schedule'];
    //元の内容
    //スケジュール　名前が違うタイトル
    $schedule = $_SESSION['schedule'];
    $count = count($schedule);
    for($i=0;$i<$count;$i++){
        $schedule[$i]['sche_title'] = $schedule[$i]['title'];
    }
    //セミナー　名前が違うタイトル再正義
    $seminar = $_SESSION['seminar'];
    $seminar['semi_title'] = $seminar['title'];
    //試用したSESSIONは
    unset($_SESSION['seminar']
        , $_SESSION['schedule']
        , $_SESSION['errorMsgs']
    );
}

if(isset($schedule)){
    $count = count($schedule);
}



//イメージ
if(is_dir($_saveDir)){
    if(is_readable($saveDir)){
        $ch_dir = dir($saveDir);
        $ln_path = $ch_dir -> path . "/" .$fileName;
        if(@getimagesize($ln_path)){
        } $ch_dir -> close();
    }
}
include_once("./seminar_write.tpl.php");
?>
