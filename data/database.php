<?php
require_once './.env';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
} catch (PDOException $e) {
    echo $e->getMessage();
}
