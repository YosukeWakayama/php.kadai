<?php

// user_selectのユーザー 一覧からユーザーをセレクト。
// 特定ユーザーのuser_tableカラム内の情報を取得、編集ができるページ
// セッションのスタート
session_start();

//0.外部ファイル読み込み
include('functions.php');

// ログイン状態のチェック

$menu = menu_kanri();

// getで送信されたidを取得
// if (!isset($_GET)) {
//   exit("Error");
// }

//DB接続します
$pdo = connectToDb();



?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>新規登録ページ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">user</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="nologin_select.php">体験版</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shinki.php">新規登録</a>
          </li>

        </ul>
      </div>
    </nav>
  </header>

  <form method="POST" action="user_insert.php">
    <div class="form-group">
      <label for="name">name</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
      <label for="lid">Login_ID</label>
      <input type="text" class="form-control" id="lid" name="lid">
    </div>
    <div class="form-group">
      <label for="lpw">Login_Pass_word</label>
      <input type="text" class="form-control" id="lpw" name="lpw">
    </div>
    <div class="form-group" hidden>
      <label for="kanri_flg">kanri_flg　※0=一般ユーザー、1=管理者</label>
      <input type="text" class="form-control" id="kanri_flg" name="kanri_flg" value="0">
    </div>
    <div class="form-group" hidden>
      <label for="life_flg">life_flg　※0=在籍中 1=退会済み</label>
      <input type="text" class="form-control" id="life_flg" name="life_flg" value="0">
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <input type="hidden" name="id" value="<?= $rs['id'] ?>">
  </form>

</body>

</html>