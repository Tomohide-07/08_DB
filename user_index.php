<?php
session_start();
require_once('funcs.php');
loginCheck();

$name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
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
    <form method="POST" action="user_insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ユーザー登録</legend>
                <label>名前：<input type="text" name="name"></label><br>
                <label>ID:<input type="text" name="lid"></label><br>
                <label>PW：<input type="text" name="lpw"></label><br>
                <label>管理者：<input type="checkbox" name="kanri_flg"></label><br>
                <label><textArea name="naiyou" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>
