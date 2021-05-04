<?php
$name = $_POST['name'];
$url = $_POST['url'];
$id = $_POST['id'];

include('funcs.php');
$pdo = db_conn();

$stmt = $pdo->prepare('UPDATE
                        gs_bookmark_table
                    SET
                        name=:name, url=:url, updated_at=NOW()
                    WHERE id=:id');
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute(); 

if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
