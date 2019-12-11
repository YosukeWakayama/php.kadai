<?php
// セッションのスタート
session_start();

// 関数ファイルの読み込み
include('functions.php');

// GETデータ取得
$user_id = $_SESSION["id"];
$task_id = $_GET['task_id'];
//DB接続
$pdo = connectToDb();
// var_dump($user_id);
// exit();


// いいね状態のチェック

$sql = 'SELECT COUNT(*) FROM like_table WHERE user_id=:a1 AND task_id=:a2';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':a2', $task_id, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
$like_count = $stmt->fetch();
}
 
// エラーでない場合，取得した件数を変数に入れる

// いいねするSQLを作成
if ($like_count[0] != 0) {  
  $sql = 'DELETE FROM like_table WHERE user_id=:a1 AND task_id=:a2';
} else {  
  $sql = 'INSERT INTO like_table (id, user_id, task_id, created_at)
  VALUES(NULL, :a1, :a2, sysdate())';
}

// SQL実行

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':a2', $task_id, PDO::PARAM_INT);
$status = $stmt->execute();
//データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} elseif($_SESSION["kanri_flg"] == 1){
  header('Location: kanri_select.php');
} else {
  header('Location: select.php');
}