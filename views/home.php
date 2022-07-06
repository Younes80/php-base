<?php
$pdo = require_once './data/database.php';

$stmt = $pdo->prepare('SELECT * FROM product');
$stmt->execute();
$fruits = $stmt->fetchAll();

$title = "PHP - Les bases (dans une variable)";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fruit = $_POST['name'];

    if (!$fruit) {
        $error = 'Champ à renseigner';
    }

    if (!$error) {


        $stmtCreate = $pdo->prepare("INSERT INTO product VALUES (DEFAULT, :name, :user_id)");
        $stmtCreate->bindValue(":name", $fruit);
        $stmtCreate->bindValue(":user_id", 1);
        $stmtCreate->execute();

        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}
?>
<div class="content">
    <h2>Listes de produit</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="text" name="name" id="name" placeholder="Nouveau fruit">
        <button type="submit">Envoyer</button>
        <?php if ($error) : ?>
            <span><?= $error ?></span>
        <?php endif; ?>
    </form>
    <ul>
        <?php foreach ($fruits as $fruit) : ?>
            <li><?= $fruit['name'] ?></li>
            <a href="./index.php?page=edit-fruit&id=<?= $fruit['id'] ?>">Modifier</a>
            <a href="./index.php?page=delete-fruit&id=<?= $fruit['id'] ?>">Supprimer</a>
        <?php endforeach; ?>
    </ul>
</div>