<?php
$pdo = require_once './data/database.php';
// $filename = __DIR__ . "/data/data.json";

$id = $_GET['id'];

if ($id) {

    $stmt = $pdo->prepare("DELETE FROM product WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();




    // $data = file_get_contents($filename);
    // $fruits = json_decode($data, true);

    // $arrayColId = array_column($fruits, 'id');
    // $fruitId = array_search($id, $arrayColId);

    // array_splice($fruits, $fruitId, 1);

    // file_put_contents($filename, json_encode($fruits));
    header('Location: /php-base');
}
