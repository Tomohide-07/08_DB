<?php
session_start();
require_once('funcs.php');
loginCheck();

$name = $_SESSION['name'];

$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_user_table');
$status = $stmt->execute();

$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<tr>';
        if ($result['kanri_flg']) {
            $view .= '<td> ✅ </td>';
        } else {
            $view .= '<td> - </td>';
        }
        $view .= '<td class="pic"><a href="user_detail.php?id=' . $result['id'] . '">';
        $view .= $result['name'];
        $view .= '</a>';
        $view .= '</td>';

        if ($result['life_flg']) {
            $view .= '<td> ✅ </td>';
        } else {
            $view .= '<td> - </td>';
        }
        $view .= '<td>';
        if ($_SESSION['kanri_flg']) {
            $view .= '<a href="delete.php?id=' . $result['id'] . '">';
            $view .= '<i class="fas fa-trash-alt"></i>';
            $view .= '</a>';
        } else {
            $view .= '-';
        }
        $view .= '</td></tr>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }

        th,
        td {
            text-align: center;
        }

        img {
            max-width: 50px;
        }
    </style>
</head>

<body id="main">
    <?php require_once('parts/header.php'); ?>

    <div>
        <h4>今ログインしているユーザー : <?= $name ?></h4>
        <div class="container jumbotron">
            <table class="table">
                <thead>
                    <tr>
                        <th>管理者</th>
                        <th>名前</th>
                        <th>退職済み</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $view ?>
                </tbody>
            </table>

        </div>
    </div>

</body>

</html>
