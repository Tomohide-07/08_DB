<?php
session_start();
require_once('funcs.php');
loginCheck();

$id = $_POST["id"];
$name = $_POST["name"];
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];
if (isset($_POST["kanri_flg"])) {
    $kanri_flg = 1;
} else {
    $kanri_flg = 0;
}
if (isset($_POST["life_flg"])) {
    $life_flg = 1;
} else {
    $life_flg = 0;
}

require_once("funcs.php");
$pdo = db_conn();

$stmt = $pdo->prepare("UPDATE
                            gs_user_table
                        SET
                            name = :name,
                            lid = :lid,
                            lpw = :lpw,
                            kanri_flg = :kanri_flg,
                            life_flg = :life_flg
                        WHERE
                            id = :id;
                        ");
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);
$stmt->bindValue(':lid', h($lid), PDO::PARAM_STR);
$stmt->bindValue(':lpw', h($lpw), PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', h($kanri_flg), PDO::PARAM_INT);
$stmt->bindValue(':life_flg', h($life_flg), PDO::PARAM_INT);
$stmt->bindValue(':id', h($id), PDO::PARAM_INT);
$status = $stmt->execute(); 

if ($status == false) {
    sql_error($stmt);
} else {
    redirect("user_select.php");
}
