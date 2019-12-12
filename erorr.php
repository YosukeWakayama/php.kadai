<?php
// セッションのスタート
session_start();

// echo $_SESSION["erorr"];
// exit("test");
//0.外部ファイル読み込み
include('functions.php');

//DB接続します
$pdo = connectToDb();

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>エラーページ</title>
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
      <a class="navbar-brand" href="#">エラーページ</a>
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
          <li class="nav-item">
            <a class="nav-link" href="saido.php">再入会</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">ログイン</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <br>
  <h3>　エラーNo.<?= $_SESSION["erorr"] ?>を検知しました。</h3>
  <p>　　詳細をご確認ください。</p>
  <br>
  <ul>
    <li>No.1 = ログインidもしくはpassにミスがあるか存在しないユーザーです。</li>
    <li>No.2 = すでに退会済みのユーザーです。上部から再入会が可能です。</li>
    <li>No.3 = ログインされていません。ログイン後、再度アクセスしてください。</li>
    <li>No.4 = 退会されていないidか、存在しないidです。</li>
    <li></li>


  </ul>



</body>

</html>