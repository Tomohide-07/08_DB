<?php
session_start();

$id = $_GET["id"];
include("funcs.php");
loginCheck();
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_bookmark_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
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

    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>[編集]</legend>
                <label>名前：<input type="text" name="name" value="<?= $row["name"] ?>"></label><br>
                <label>URL：<input type="text" name="url" value="<?= $row["url"] ?>"></label><br>
                <input type="submit" value="送信">
                <input type="hidden" name="id" value="<?= $id ?>">
            </fieldset>
        </div>
    </form>
</body>

</html>
