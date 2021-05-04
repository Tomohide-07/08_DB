<?php
session_start();
include("funcs.php");

$name = $_SESSION['name'] ? $_SESSION['name'] : 'ゲストユーザー';

$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM gs_bookmark_table");
$status = $stmt->execute();

$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<tr>';
        if ($_SESSION) {
            $view .= '<td class="pic"><a href="detail.php?id=' . $result["id"] . '">';
            $view .= $result['name'];
            $view .= '</a>';
        } else {
            $view .= '<td>' . $result['name'];
        }
        $view .= '</td>';

        $view .= '<td>';
        if ($result['url']) {
            $view .= '<a href="' . $result['url'] . '">リンク</a>';
        } else {
            $view .= ' - ';
        }
        $view .= '</td>';

        $view .= '<td>';
        $view .= $result['register'];
        $view .= '</td>';

        $view .= '<td>';
        $view .= $result['created_at'];
        $view .= '</td>';

        $view .= '<td>';
        $view .= $result['updated_at'];
        $view .= '</td><td>';


        if ($_SESSION["kanri_flg"]) {
            $view .= '<a href="delete.php?id=' . $result["id"] . '">';
            $view .= '<i class="fas fa-trash-alt"></i>';
            $view .= '</a>';
        } else {
            $view .= '権限無いよ';
        }
        $view .= '</td></tr>';
    }
}
if (!$view) {
    $view = '登録無いよ';
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ブックマーク表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <?php require_once('parts/header.php'); ?>
    <h4>今ログインしているユーザー : <?= $name ?></h4>
    <div>
        <div class="container jumbotron">
            <table class="table">
                <thead>
                    <tr>
                        <th>本の名前</th>
                        <th>本のURL</th>
                        <th>登録者</th>
                        <th>登録日</th>
                        <th>更新日</th>

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
