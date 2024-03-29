<?php
// セッションのスタート
session_start();

include('functions.php');

$menu = menu_kanri();
// ユーザーidの指定（今回は固定値）
$user_id = $_SESSION["id"];

checkSessionId();
//DB接続
$pdo = connectToDb();

//データ表示SQL作成
$sql = 'SELECT * FROM php02_table LEFT OUTER JOIN (SELECT task_id, COUNT(id) AS cnt FROM like_table GROUP BY task_id) AS likes 
ON php02_table.id = likes.task_id';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//データ表示
$view = '';
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<li class="list-group-item">';
    $view .= '<p>' . $result['deadline'] . '-' . $result['task'] . '</p>';
    // いいねボタン
    $view .= '<a href="like_insert.php?task_id=' . $result['id'] .
      '&user_id=' . $user_id . '" class="badge badge-primary">Like' . $result['cnt'] . '</a>';
    $view .= '<a href="detail.php?id=' . $result['id'] . '" class="badge badge-primary">Edit</a>';
    $view .= '<a href="delete.php?id=' . $result['id'] . '" class="badge badge-danger">Delete</a>';
    $view .= '</li>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>todoリスト表示</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>

<body style="background-color: lightskyblue;">

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">todo一覧</a>
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



  <div id="list">
    <ul class="list-group">
      <?= $view ?>
    </ul>
  </div>

</body>


</html>