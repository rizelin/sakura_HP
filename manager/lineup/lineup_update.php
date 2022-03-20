<?php
ini_set('display_errors',1);
require_once("../../require/mysql.php");
require_once("../require/login.php");
if (isset($_POST['lineup'])) {

  $lineup = $_POST['lineup'];
echo var_dump($lineup);
  if(!isset($lineup['top_preview'])){
    $lineup['top_preview'] = 0;
  }

  echo "<br>".var_dump($lineup);

  //datetime
  $lineup_datetime = $_POST['lineup_datetime'];
  $lineup['public_datetime'] = $lineup_datetime['public_date'].'T'.$lineup_datetime['public_time'];
  $lineup['limit_datetime'] = $lineup_datetime['limit_date'].'T'.$lineup_datetime['limit_time'];

  $allowColumns = array(
                        'id' => 'ID' ,
                        'name' => 'タイトル',
                        'caption' => '見出し',
                        'img' => 'イメージ',
                        'text' => '本文',
                        'public_datetime' => '公開日時',
                        'limit_datetime' => '制限日付',
                        'status' => '公開範囲',
                        'top_preview' => 'トップページ公開'
                      );
  $requiredInputs = array('name','caption','text','public_datetime');
  $errorTypes = array(
                      '1' => 'が入力されていませんでした。' ,
                      '2' => 'が不正に入力されました。',
                      '3' => '最大アップロードサイズは2MBです。'
                      );

  //エラー処理
  foreach ($requiredInputs as $key => $value) {
    if (empty($lineup[$value])) {
      $errors[$value] = '1';
    }
  }
  foreach ($lineup as $key => $value) {
      if (!in_array($key,array_keys($allowColumns))) {
          $errors[$key] = '2';
      }
  }
  if ($_FILES['img']['error']==1) {
    $errors['img'] = '3';
  }

  //分岐処理
  if (isset($errors)) {
      $errorMsgs = array();
      foreach ($errors as $key => $value) {
          $errorMsgs[$key] = "{$allowColumns[$key]}{$errorTypes[$value]}";
      }
  }else {
      //日付の文字列変更
      $lineup['public_datetime'] = str_replace("T"," ",$lineup['public_datetime']);
      $lineup['limit_datetime']= str_replace("T"," ",$lineup['limit_datetime']);

      //file処理
        if(!empty($_FILES['img']['name']) || isset($_POST['img_delete'])) {
            $saveDir = "/home/.sites/45/site47/web/common/img/lineup/";
            $path = $saveDir.$lineup['img'];
            @unlink($path);

            if (!empty($_FILES['img']['name'])) {
                $lineup['img'] = $_FILES['img']['name'];
                if (is_uploaded_file($_FILES['img']['tmp_name'])) {
                      if (move_uploaded_file($_FILES['img']['tmp_name'],$saveDir.$lineup['img'])) {
                          echo "FILES['img']['tmp_name']代入：　".$lineup['img'];
                      }else {
                          $errorMsgs = "ファイルアプロードに失敗しました。";
                      }
                }
            }elseif ($_POST['img_delete'] == 1) {
                $lineup['img'] = '';
            }
      }

      //sql準備
      $sqlFlg = FALSE;
      $columns = array();
      $values = array();
      foreach ($allowColumns as $key => $value) {
          if (isset($lineup[$key]) && $key!='top_preview') {
              $columns[] = "`{$key}`";
              if (empty($lineup[$key]) && $key!='top_preview') {
                  $values[] = "NULL";
              }else {
                  $values[] = "'".$_link->real_escape_string($lineup[$key])."'";
              }
          }
      }

      //insert新規作成
      if (is_null($lineup['id'])) {
          $columns = implode(',',$columns);
          $values = implode(',',$values);
          $sql = "INSERT INTO `lineup` ($columns,`top_preview`,`registration_datetime`) VALUES ($values,{$lineup['top_preview']},NULL)";
          echo $sql;
          exit();
          if ($res = $_link->query($sql)) {
              if ($_link->affected_rows == 1) {
                  $sqlFlg = TRUE;
              }
          }
      }else {//修正・削除
          $updateSet = array();
          foreach ($columns as $key => $value) {
              if ($value != "`id`") {
                  $updateSet[] = "$value={$values[$key]}";
              }
          }
          $updateSet = implode(",",$updateSet);

          $sql = "UPDATE `lineup` SET $updateSet,`top_preview`={$lineup['top_preview']} WHERE `id`= {$lineup['id']}";
          if ($res = $_link->query($sql)) {
                $sqlFlg = TRUE;
          }
      }

  }

  if (isset($errorMsgs)) {
      $_SESSION['error'] = $errorMsgs;
      $_SESSION['lineup'] = $lineup;
      header("location:./lineup_write.php");
      exit();
  }
  if ($sqlFlg) {
      $_link->commit();
      $lineup['status']==3?  $_SESSION['confirmMsg'] ="記事削除完了しました。" : $_SESSION['confirmMsg'] ="記事登録完了しました。";
      header("location:./lineup_board.php");
      exit();
  }else {
      $_link->rollback();
  }

}else {
    header("location:./lineup_board");
    exit();
}
?>
