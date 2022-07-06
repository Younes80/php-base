<?php
$pdo = require_once './data/database.php';

$id = $_GET['id'];

if ($id) {

    $stmt = $pdo->prepare("DELETE FROM product WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    header('Location: index.php?page=home');
}
