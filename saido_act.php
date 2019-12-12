


<?php
include('functions.php');

// //入力チェック(受信確認処理追加)
// if (
//   !isset($_POST['task']) || $_POST['task'] == '' ||
//   !isset($_POST['deadline']) || $_POST['deadline'] == ''
// ) {
//   exit('ParamError');
// }

//1. POSTデータ取得
$lid     = $_POST['lid'];
$lpw   = $_POST['lpw'];
$life_flg  = 0;


//2. DB接続します(エラー処理追加)
$pdo = connectToDb();

//3．データ登録SQL作成
$sql = 'UPDATE user_table SET life_flg=:a1  WHERE lid=:lid';

// var_dump($life_flg);
// exit("test");
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $life_flg, PDO::PARAM_INT);
$stmt->bindValue(':lid', $lid,     PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($status);
// exit("test");
//4．データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  header('Location: login.php');
  exit;
}
