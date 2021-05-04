<?php
session_start();
require_once('funcs.php');
loginCheck();

$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
if (isset($_POST["kanri_flg"])) {
    $kanri_flg = 1;
} else {
    $kanri_flg = 0;
}

$pdo = db_conn();

$stmt = $pdo->prepare("INSERT INTO
                        gs_user_table(name, lid,lpw, kanri_flg)
                        VALUES
                        (:name, :lid, :lpw, :kanri_flg)");
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);
$stmt->bindValue(':lid', h($lid), PDO::PARAM_STR);
$stmt->bindValue(':lpw', h($lpw), PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', h($kanri_flg), PDO::PARAM_STR);
$status = $stmt->execute(); 

if ($status == false) {
    sql_error($stmt);
} else {
    redirect("index.php");
}
