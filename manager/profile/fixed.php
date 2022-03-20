<?php
ini_set('display.errors',1);

require_once("../require/mysql.php");
require_once("../require/login.php");

if (isset($_GET['fixed_id'])) {
    $sql = "SELECT * FROM `fixed_page` WHERE `id`={$_GET['fixed_id']}";
    if ($res = $_link->query($sql)) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
          $fixed = $row;
          $fixed['public_datetime'] = str_replace(" ","T",$fixed['public_datetime']);
          $fixed['limit_datetime'] = str_replace(" ","T",$fixed['limit_datetime']);
          $fixed['public_datetime'] = explode("T",$fixed['public_datetime']);
          $fixed['limit_datetime'] = explode("T",$fixed['limit_datetime']);
        }
    }
}

if(isset($_POST['fixed'])){
$fixed = $_POST['fixed'];
//datetime
$fixed_datetime = $_POST['fixed_datetime'];
$fixed['public_datetime'] = $fixed_datetime['public_date'].'T'.$fixed_datetime['public_time'];
$fixed['limit_datetime'] = $fixed_datetime['limit_date'].'T'.$fixed_datetime['limit_time'];



    //全体項目
    $allowColumns = array(
        'id' => 'ID'
        ,'title' => 'タイトル'
        ,'text' => '本文'
        ,'public_datetime' => '公開日付'
        ,'limit_datetime' => '制限日付'
        ,'status' => '公開状態'
    );
    //必須項目
    $requiredInputs = array(
        'title'
        ,'text'
    );
    $errorTypes = array('1' => 'が未入力です','2' => 'が不正な入力です');

    foreach ($requiredInputs as $key => $val) {
      if (empty($fixed[$val])) {
        $errors[$val] = '1';
      }
    }
    foreach ($fixed as $key => $val) {
        if(!in_array($key, array_keys($allowColumns))){
            $errors[$key] = '2';
        }
    }

    if(isset($errors)){
        $errorMsgs = array();
        foreach($errors as $key => $val){
            $errorMsgs[$key] = "{$allowColumns[$key]}{$errorTypes[$val]}";
        }
    }else{
      $fixed['public_datetime'] = (empty($fixed['public_datetime']))? date('Y-m-d H:i:s') : str_replace("T"," ",$fixed['public_datetime']);
      $fixed['limit_datetime'] = str_replace("T"," ",$fixed['limit_datetime']);

      //sql準備
      $sqlFlg = FALSE;
      $columns = array();
      $values = array();
      foreach ($allowColumns as $key => $val) {
        if(isset($fixed[$key])){
          $columns[] = "`{$key}`";
          if(empty($fixed[$key])){
            $values[] = "NULL";
          }
          else {
            $values[] = "'".$_link->real_escape_string($fixed[$key])."'";
          }
        }
      }
      //新規作成
      if(empty($fixed['id'])){
        $columns = implode(',',$columns).",`manager_id`,`registration_datetime`";
        $values = implode(',',$values).",{$user['id']},NULL";
        $sql = "INSERT INTO `fixed_page` ($columns) VALUES ($values)";
        if($res = $_link->query($sql)) {
            if($_link->affected_rows == 1) {
                $sqlFlg = TRUE;
            }
        }
      }else {
        $updateSet = array();
        foreach ($columns as $key => $value) {
            if ($value != "`id`") {
                $updateSet[] = "$value={$values[$key]}";
            }
        }
        $updateSet = implode(",",$updateSet);
        $sql = "UPDATE `fixed_page` SET $updateSet WHERE `id`= {$fixed['id']}";
        if ($res = $_link->query($sql)) {
            if ($_link->affected_rows == 1) {
                $sqlFlg = TRUE;
            }
        }
      }

    }

    if($sqlFlg){
        $_link->commit();
        $_SESSION['confirmMsg'] ="記事登録完了しました。";
        header('location:./profile.php');
    }else {
        $_link->rollback();
    }
}

include_once("./fixed.tpl.php");
?>
