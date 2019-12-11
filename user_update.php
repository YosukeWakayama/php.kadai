<?php

include('functions.php');

//入力チェック(受信確認処理追加)
if (
  !isset($_POST['id']) || $_POST['id'] == '' ||
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_POST['lid']) || $_POST['lid'] == '' ||
  !isset($_POST['lpw']) || $_POST['lpw'] == '' ||
  !isset($_POST['kanri_flg']) || $_POST['kanri_flg'] == '' ||
  !isset($_POST['life_flg']) || $_POST['life_flg'] == ''
) {
  exit('ParamError');
}

//1. POSTデータ取得
$id         = $_POST['id'];
$name       = $_POST['name'];
$lid        = $_POST['lid'];
$lpw        = $_POST['lpw'];
$kanri_flg  = $_POST['kanri_flg'];
$life_flg   = $_POST['life_flg'];

//2. DB接続します(エラー処理追加)
$pdo = connectToDb();

// "id"
// "name"
// "lid"
// "lpw"
// "kanri_flg"
// "life_flg"
// var_dump($id);
// exit("test");

//3．データ登録SQL作成
$sql = 'UPDATE user_table SET id=:a1, name=:a2, lid=:a3, lpw=:a4, kanri_flg=:a5, life_flg=:a6 WHERE id=:id';

// $sql = 'UPDATE user_table SET id=$id, name=$name, lid=$lid, lpw=$lpw, kanri_flg=$kanri_flg, life_flg=$life_flg WHERE id=$id';
// var_dump($sql);
// exit("test");
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $id,        PDO::PARAM_INT);
$stmt->bindValue(':a2', $name,      PDO::PARAM_STR);
$stmt->bindValue(':a3', $lid,       PDO::PARAM_STR);
$stmt->bindValue(':a4', $lpw,       PDO::PARAM_STR);
$stmt->bindValue(':a5', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':a6', $life_flg,  PDO::PARAM_INT);
$stmt->bindValue(':id', $id,        PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($status);
// exit("test");


//4．データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  header('Location: user_select.php');
  exit;
}
