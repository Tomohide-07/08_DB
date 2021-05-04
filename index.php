<?php
session_start();
$name = $_SESSION['chk_ssid'] ? $_SESSION['name'] : 'ゲストユーザー';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>bookmark登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <?php require_once('parts/header.php'); ?>
    <h4>今ログインしているユーザー : <?= $name ?></h4>
    <form method="POST" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>bookmark登録</legend>
                <label>本の名前：<input type="text" name="name"></label><br>
                <label>本のURL<input type="text" name="url"></label><br>
                <input type="hidden" name="register" value="<?= $name ?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>
