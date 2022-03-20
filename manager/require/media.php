<?php
ini_set('display.errors',1);
require_once("../require/mysql.php");
require_once("../require/login.php");
$saveDir = "/home/.sites/45/site47/web/common/media/";

//エラー
if ($_FILES['media']['error'] != 0) {
  $resultMsg = "アップロードエラー";
}

//アプロード
if (!empty($_FILES['media']['name'])) {
      //ファイル拡張子確認
      $ext = pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);
      $fileName = date("YmdHis").".".$ext;

      if (is_uploaded_file($_FILES['media']['tmp_name'])) {
            if (move_uploaded_file($_FILES['media']['tmp_name'],$saveDir.$fileName)) {
              $resultMsg = "アップロード完了";
            }
      }
}

//削除
if (isset($_POST['delete'])) {
    foreach ($_POST['delete'] as $key => $postVal) {
        $path = $saveDir.$postVal;
        @unlink($path);
        $resultMsg = "削除完了";
    }
}

//フォルダのファイル収得
if (is_dir($saveDir)){
    if(is_readable($saveDir)){
        $ch_dir = dir($saveDir); //ディレクトリクラス
        $imgArrs = array();
        while (false !== ($fileName = $ch_dir -> read())){
              $ln_path = $ch_dir -> path . "/" .$fileName;
              if (@getimagesize($ln_path)){
                  $imgArrs[] = $fileName;
              }
        }
        $ch_dir -> close();
    }
}
include_once("./media.tpl.php");
?>
