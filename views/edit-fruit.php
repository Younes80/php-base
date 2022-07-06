<?php
$pdo = require_once './data/database.php';

$id = $_GET['id'] ?? '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $fruits = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fruit = $_POST['name'];

    $stmtDelete = $pdo->prepare("UPDATE product SET name = :name WHERE id = :id");
    $stmtDelete->bindValue(":name", $fruit);
    $stmtDelete->bindValue(":id", $id);
    $stmtDelete->execute();

    header('Location: index.php?page=home');
}
?>
<form action="" method="POST">
    <input type="text" name="name" id="name" value="<?= $fruits['name'] ?>">
    <button>Confirmer</button>
</form>