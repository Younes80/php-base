<?php
$pdo = require_once './data/database.php';
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
// die();
$filename = __DIR__ . "/data/data.json";

$id = $_GET['id'] ?? '';


if ($id) {

    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $fruits = $stmt->fetch();


    // $data = file_get_contents($filename);
    // $fruits = json_decode($data, true);
    // $arrayColId = array_column($fruits, 'id');
    // $fruitId = array_search($id, $arrayColId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fruit = $_POST['name'];

    $stmtDelete = $pdo->prepare("UPDATE product SET name = :name WHERE id = :id");
    $stmtDelete->bindValue(":name", $fruit);
    $stmtDelete->bindValue(":id", $id);
    $stmtDelete->execute();

    // $fruits[$fruitId]['fruit'] = $fruit;
    // file_put_contents($filename, json_encode($fruits));
    header('Location: /php-base');
}



?>


<form action="" method="POST">

    <input type="text" name="name" id="name" value="<?= $fruits['name'] ?>">
    <button>Confirmer</button>

</form>