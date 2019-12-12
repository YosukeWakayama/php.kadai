<?
// セッションのスタート
session_start();

//0.外部ファイル読み込み
include('functions.php');

$menu = menu_kanri();

// getで送信されたidを取得
if (!isset($_POST)) {
  exit("Error");
}

//DB接続します
$pdo = connectToDb();
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
// var_dump($_POST);
// exit();
// var_dump($id);




//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM user_table WHERE lid=:lid ,lpw=:lpw';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_INT);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($status);
// exit("ok");
//データ表示
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  $rs = $stmt->fetch();
  var_export($rs);
}

// if ($rs["lid"] == ) { } else {
//   $_SESSION["erorr"] = 4;
//   header("Location: erorr.php");
// }



?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>user更新ページ</title>
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
      <a class="navbar-brand" href="#">user更新</a>
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
<form>
  <!-- <form method="POST" action="user_update"> -->
    <!-- <div class="form-group">
      <label for="id">id　※変更不可</label>
      <input readonly type="text" class="form-control" id="id" name="id" value="<?= $rs['id'] ?>">
    </div>
    <div class="form-group">
      <label for="name">name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?= $rs['name'] ?>">
    </div> -->
    <!-- 正解Login-id -->
    <div class="form-group">
      <label for="lid">正解Login_ID</label>
      <input readonly type="text" class="form-control" id="true_lid" value="<?= $rs['lid'] ?>">
    </div>
    <!-- 入力Login-id -->
    <div class="form-group">
      <label for="lid">Login_ID</label>
      <input type="text" class="form-control" id="lid" name="lid">
    </div>
    <!-- 正解Login-pass -->
    <div class="form-group">
      <label for="lpw">正解Login_Pass_word</label>
      <input readonly type="text" class="form-control" id="true_lpw" value="<?= $rs['lpw'] ?>">
    </div>
    <!-- 入力Login-pass -->
    <div class="form-group">
      <label for="lpw">Login_Pass_word</label>
      <input type="text" class="form-control" id="lpw" name="lpw">
    </div>
    <div class="form-group" hidden>
      <label for="kanri_flg">kanri_flg　※0=一般ユーザー、1=管理者</label>
      <input type="text" class="form-control" id="kanri_flg" name="kanri_flg" value="<?= $rs['kanri_flg'] ?>">
    </div>
    <div class="form-group" hidden>
      <label for="life_flg">life_flg　※0=在籍中 1=退会済み</label>
      <input type="text" class="form-control" id="life_flg" name="life_flg" value=0>
    </div>


    <div class="form-group">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(function() {
    //ここに自分の処理を追加! 

    // console.log($("true_lid").value());


    const t_val_lid = document.getElementById('true_lid').value;
    console.log(t_val_lid);
    const val_lid = document.getElementById('lid').value;
    console.log(val_lid);

    $(".btn btn-primary").on("click", function() {
      if (t_val_lid == val_lid) {
        alert.log("ok");
      } else {
        alert.log("ng");
      }
    });



  });
</script>

</html>