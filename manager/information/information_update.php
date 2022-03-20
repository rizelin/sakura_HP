<?php
require_once("../require/mysql.php");
require_once("../require/login.php");

if (isset($_POST['information'])) {
  $information = $_POST['information'];
  //datetime
  $information_datetime = $_POST['information_datetime'];
  $information['public_datetime'] = $information_datetime['public_date'].'T'.$information_datetime['public_time'];
  $information['limit_datetime'] = $information_datetime['limit_date'].'T'.$information_datetime['limit_time'];
  
  $allowColumns = array(
                        'id' => 'ID' ,
                        'manager_id' => '作成者',
                        'title' => 'タイトル',
                        'text' => '本文',
                        'public_datetime' => '公開日時',
                        'limit_datetime' => '制限日付',
                        'status' => '公開範囲'
                      );
  $requiredInputs = array('title','text','public_datetime','status');
  $errorTypes = array(
                      '1' => 'が入力されていませんでした。' ,
                      '2' => 'が不正に入力されました。'
                      );
  //エラー処理
  foreach ($requiredInputs as $key => $value) {
      if (empty($information[$value])) {
          $errors[$value] = '1';
      }
  }
  foreach ($information as $key => $value) {
      if (!in_array($key,array_keys($allowColumns))) {
          $errors[$key] = '2';
      }
  }
  //分岐処理
  if (isset($errors)) {
      $errorMsgs = array();
      foreach ($errors as $key => $value) {
          $errorMsgs[$key] = "{$allowColumns[$key]}{$errorTypes[$value]}";
      }
  }else {
    //日付の文字列変更
    $information['public_datetime'] = str_replace("T"," ",$information['public_datetime']);
    $information['limit_datetime']= str_replace("T"," ",$information['limit_datetime']);

    //insert,update,error判断
      $sqlFlg = FALSE;
      $columns = array();
      $values = array();
      foreach ($allowColumns as $key => $value) {
          if (isset($information[$key])) {
              $columns[] = "`{$key}`";
              if (empty($information[$key])) {
                  $values[] = "NULL";
              }else {
                  $values[] = "'".$_link->real_escape_string($information[$key])."'";
              }
          }
      }

      //新規登録
      if (is_null($information['id'])) {
        $columns = implode(',',$columns).",`manager_id`,`registration_datetime`";
        $values = implode(',',$values).",{$user['id']},NULL";
          $sql = "INSERT INTO `information` ($columns) VALUES ($values)";
            if ($res = $_link->query($sql)) {
              if ($_link->affected_rows == 1) {
                  $sqlFlg = TRUE;
              }
          }//DELETE・UPDATE処理
      }else {
          $updateSet = array();
          foreach ($columns as $key => $value) {
              if ($value != "`id`") {
                  $updateSet[] = "$value={$values[$key]}";
              }
          }
          $updateSet = implode(",",$updateSet);
          $sql = "UPDATE `information` SET $updateSet WHERE `id`='{$information['id']}'";
          if($res = $_link->query($sql)){
            if ($_link->affected_rows == 1) {
                $sqlFlg = TRUE;
            }
          }
        }
  }

  if (isset($errorMsgs)) {
      $_SESSION['error'] = $errorMsgs;
      $_SESSION['information'] = $information;
      header("location:./information_write.php");
      exit();
  }
  if ($sqlFlg) {
      $_link->commit();
      $information['status']==3? $_SESSION['confirmMsg'] ="記事削除完了しました。" : $_SESSION['confirmMsg'] ="記事登録完了しました。";
      header("location:./information_board.php");
      exit();
  }else {
      $_link->rollback();
  }

}else {
  header("location:./information_board.php");
  exit();
}
 ?>
