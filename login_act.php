<?php
//最初にSESSIONを開始！！

// var_dump($_POST);
// exit("ok");
session_start();
//0.外部ファイル読み込み
include("functions.php");

//1.  DB接続&送信データの受け取り
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$pdo = connectToDb();
//2. データ登録SQL作成&実行

var_dump($lpw);
// exit("aa");

$sql = 'SELECT * FROM user_table WHERE lid=:lid AND lpw=:lpw AND life_flg=0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();



//3. SQL実行時にエラーがある場合
if ($status == false) {
  showSqlErrorMsg($stmt);
}
// var_dump($status);
// exit("ok");
//4. データを取得した場合
$val = $stmt->fetch();


//5. 該当レコードがあればSESSIONに値を代入
if ($val['id'] != '') {
  // ログイン成功の場合はセッション変数に値を代入
$_SESSION = array();
  $_SESSION["session_id"] = session_id();
  $_SESSION["kanri_flg"] = $val["kanri_flg"];
  $_SESSION["name"] = $val["name"];
  $_SESSION["id"] = $val["id"];
  header('Location: select.php');
} else {
  //ログイン失敗の場合はログイン画面へ戻る
header("Location: login.php");
}

exit();
