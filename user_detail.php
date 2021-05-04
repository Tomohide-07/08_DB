<?php
session_start();

$id = $_GET["id"];
include('funcs.php');
loginCheck();
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();


if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}

if (!$row) {
    header('Location: index.php');
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

    <h4>※通常パスワードはハッシュ化して登録します。練習のためにIDとともに表示しています。</h4>
    <form method="POST" action="user_update.php">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="jumbotron">
            <fieldset>
                <legend>[編集]</legend>
                <label>名前：<input type="text" name="name" value="<?= $row["name"] ?>"></label><br>
                <label>ID:<input type="text" name="lid" value="<?= $row["lid"] ?>"></label><br>
                <label>PW：<input type="text" name="lpw" value="<?= $row["lpw"] ?>"></label><br>
                <label>管理者：<input type="checkbox" name="kanri_flg" <?php echo ($row["kanri_flg"] ? 'checked' : '') ?>></label><br>
                <label>退職者：<input type="checkbox" name="life_flg" <?php echo ($row["life_flg"] ? 'checked' : '') ?>></label><br>
                <small>退職済みの社員はチェックを入れて登録してください。</small>
                <br>
                <input class="btn btn-primary" type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>
