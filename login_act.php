<?php
//最初にSESSIONを開始！！
session_start();
// var_dump($_POST);
// exit("ok");

//0.外部ファイル読み込み
include("functions.php");

//1.  DB接続&送信データの受け取り
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$pdo = connectToDb();
//2. データ登録SQL作成&実行

// var_dump($lpw);
// exit("lpwの出力");

$sql = 'SELECT * FROM user_table WHERE lid=:lid AND lpw=:lpw';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合
if ($status == false) {
  showSqlErrorMsg($stmt);
}elseif($status != false){
  $_SESSION["erorr"] = 1;
  echo $_SESSION["erorr"];
  header("Location: erorr.php");
exit();
}

// var_aadump($status);
// exit("ok");
//4. データを取得した場合
$val = $stmt->fetch();

//5. 該当レコードがあればSESSIONに値を代入
if ($val['kanri_flg'] == 1) {
  // 管理者
  // ログイン成功の場合はセッション変数に値を代入
  $_SESSION = array();
  $_SESSION["session_id"] = session_id();
  $_SESSION["kanri_flg"]  = $val["kanri_flg"];
  $_SESSION["life_flg"]   = $val["life_flg"];
  $_SESSION["name"]       = $val["name"];
  $_SESSION["id"]         = $val["id"];
  // exit("kanri");
  if($val['life_flg'] == '0'){
    header('Location: user_select.php');
  } elseif ($val['life_flg'] == '1') {
    $_SESSION["erorr"] = 2;         // 退会済み
    header("Location: erorr.php");
  }
  } elseif ($val['kanri_flg'] == 0) {
  // 一般ユーザー
  // ログイン成功の場合はセッション変数に値を代入
  $_SESSION = array();
  $_SESSION["session_id"] = session_id();
  $_SESSION["kanri_flg"]  = $val["kanri_flg"];
  $_SESSION["life_flg"]   = $val["life_flg"];
  $_SESSION["name"]       = $val["name"];
  $_SESSION["id"]         = $val["id"];
  // exit("ippan");
  if ($val['life_flg'] == '0') {
    header('Location: select.php');
  } elseif ($val['life_flg'] == '1') {
    $_SESSION["erorr"] = 2;
    // 退会済み
    header("Location: erorr.php");
  }
}else{
  //ログイン失敗の場合はログイン画面へ戻る
$_SESSION["erorr"] = 1;
header("Location: erorr.php");
}

exit();
