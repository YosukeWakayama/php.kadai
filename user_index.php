<?php
// セッションのスタート
session_start();

//0.外部ファイル読み込み
include('functions.php');

// ログイン状態のチェック
checkSessionId();

$menu = menu();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>todo登録</title>
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
      <a class="navbar-brand" href="#">User登録</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <?= $menu ?>
        </ul>
      </div>
    </nav>
  </header>

  <form method="POST" action="user_insert.php">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="name" class="form-control" id="name" name="name" placeholder="Name">
    </div>
    <div class="form-group">
      <label for="lid">Login_ID</label>
      <input type="text" class="form-control" id="lid" name="lid" placeholder="Login_ID">
    </div>
    <div class="form-group">
      <label for="lpw">Login_Pass_word</label>
      <input class="form-control" id="lpw" name="lpw" placeholder="Pass word"></textarea>
    </div>
    <div class="form-group">
      <label for="kanri_flg" hidden>kanri_flg</label>
      <textarea class="kanri_flg" id="kanri_flg" name="kanri_flg" hidden>0</textarea>
    </div>
    <div class="form-group">
      <label for="life_flg" hidden>life_flg</label>
      <textarea class="form-control" id="life_flg" name="life_flg" hidden>0</textarea>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

</body>

</html>