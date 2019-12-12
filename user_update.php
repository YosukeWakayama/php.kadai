<?php

include('functions.php');
// var_dump($_POST);
// exit("ok");

//入力チェック(受信確認処理追加)
$user_nyuryoku = connectToDb();

//1. POSTデータ取得
// $user_syutoku = connectToDb();
{
  $id         = $_POST['id'];
  $name       = $_POST['name'];
  $lid        = $_POST['lid'];
  $lpw        = $_POST['lpw'];
  $kanri_flg  = $_POST['kanri_flg'];
  $life_flg   = $_POST['life_flg'];
  // var_dump($id);
  // exit("test");
}

//2. DB接続します(エラー処理追加)
$pdo = connectToDb();

//3．データ登録SQL作成
$sql = 'UPDATE user_table SET id=:a1, name=:a2, lid=:a3, lpw=:a4, kanri_flg=:a5, life_flg=:a6 WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $id,        PDO::PARAM_INT);
$stmt->bindValue(':a2', $name,      PDO::PARAM_STR);
$stmt->bindValue(':a3', $lid,       PDO::PARAM_STR);
$stmt->bindValue(':a4', $lpw,       PDO::PARAM_STR);
$stmt->bindValue(':a5', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':a6', $life_flg,  PDO::PARAM_INT);
$stmt->bindValue(':id', $id,        PDO::PARAM_INT);
$status = $stmt->execute();


//4．データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  header('Location: user_select.php');
  exit;
}
