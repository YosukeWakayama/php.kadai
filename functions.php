<?php
// 共通で使うものを別ファイルにしておきましょう。

// DB接続関数（PDO）
function connectToDb()
{
  $db = 'mysql:dbname=gsacfl02_06;charset=utf8;port=3308;host=localhost';
  $user = 'root';
  $pwd = '';
  try {
    return new PDO($db, $user, $pwd);
  } catch (PDOException $e) {
    exit('dbError:' . $e->getMessage());
  }
}

// SQL処理エラー
function showSqlErrorMsg($stmt)
{
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
}

// SESSIONチェック＆リジェネレイト
function checkSessionId () {
if (!isset($_SESSION['session_id']) ||
$_SESSION['session_id']!=session_id()){ 
  header('Location: login.php'); 
  } else {
session_regenerate_id(true); 
$_SESSION['session_id'] = session_id();
  }
};
// ログイン失敗時の処理（ログイン画面に移動）
// ログイン成功時の処理（一覧画面に移動）

// menuを決める
function menu()
{
  $menu = '<li class="nav-item"><a class="nav-link" href="index.php">todo登録</a></li><li class="nav-item"><a class="nav-link" href="select.php">todo一覧</a></li>';
  $menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
  return $menu;
}