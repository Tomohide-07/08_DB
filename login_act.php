<?php
session_start();
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

include("funcs.php");
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid = :lid AND lpw = :lpw");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();


if ($status == false) {
    sql_error($stmt);
}


$val = $stmt->fetch(); 

if ($val["id"] != "") {

    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"]      = $val['name'];
    header('Location: select.php');
} else {
    header('Location: login.php');
}

exit();
