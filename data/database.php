<?php
require_once './.env';
// $pdo = new PDO('mysql:host=localhost;dbname=sql_base', 'root', 'ApQm102938475G!!');
// echo 'connexion ok';
// return $pdo;




try {
    $pdo = new PDO('mysql:host=localhost;dbname=sql_base', $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
} catch (PDOException $e) {
    echo $e->getMessage();
}
