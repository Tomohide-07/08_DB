<?php
$name = $_POST['name'];
$url = $_POST['url'];
$register = $_POST['register'];

include('funcs.php');
$pdo = db_conn();

$stmt = $pdo->prepare('INSERT INTO gs_bookmark_table(name, url, register, created_at)VALUES(:name, :url, :register, NOW())');
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':register', $register, PDO::PARAM_STR);
$status = $stmt->execute(); 

if ($status == false) {
    sql_error($stmt);
} else {
    redirect('index.php');
}
