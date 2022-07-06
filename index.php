<?php

$pdo = require_once './data/database.php';

// On met en place les instructions 


$stmt = $pdo->prepare('SELECT * FROM product');
$stmt->execute();
$fruits = $stmt->fetchAll();

// echo '<pre>';
// print_r($fruits);
// echo '</pre>';

// die();


// $filename = __DIR__ . "/data/data.json";


$title = "PHP - Les bases (dans une variable)";
$error = "";
// $fruits = [];

// if (file_exists($filename)) {
//     $data = file_get_contents($filename);
//     $fruits = json_decode($data, true);
// }

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

        // $fruits = [...$fruits, [
        //     'fruit' => $fruit,
        //     'id' => time()
        // ]];
        // file_put_contents($filename, json_encode($fruits));
        // $fruit = '';
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title; ?>
    </title>
</head>

<body>

    <?php include_once './includes/header.php'; ?>

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
                <a href="edit-fruit.php?id=<?= $fruit['id'] ?>">Modifier</a>
                <a href="delete-fruit.php?id=<?= $fruit['id'] ?>">Supprimer</a>
            <?php endforeach; ?>
        </ul>
    </div>


    <?php include_once './includes/footer.php'; ?>

</body>

</html>