<?php
ini_set('display_errors',1); //에러를 확인하는 문구 1:에러표시 0:표시안함
session_start();
//DBの接続
require_once("./require/mysql.php");

//ログアウト
if(isset($_GET['logout'])){       //GET에서 logout정보를 확인함
  unset($_SESSION['id'],$_SESSION['password']); //디스트로이 대신에 unset사용하면 필요한 세션만 지움
  header("Location:./index.php"); //header자동으로 페이지 이동
  exit();                         //header사용시 사용하는 종료문구 dai도 가능
}

if(isset($_POST['id'])){
  //sha256
  $password = $_POST['password'];
  $hash = hash('sha256',$password);
  //セッション
  $_SESSION['id'] = $_POST['id'];
  $_SESSION['password'] = $hash;
}

if(isset($_SESSION['id'])){       //isset은 정의가 되어있으면 true, in_null null이면 true
  header("Location:./require/main.php");
  exit();
}

include_once("./index.tpl.php");
?>
