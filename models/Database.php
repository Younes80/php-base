<?php
require_once './.env';



class Database
{

    private static $pdo;

    private static function setBdd()
    {
        self::$pdo = new PDO('mysql:host=localhost;dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        self::$pdo->exec("SET CHARACTER SET utf8");
    }

    protected function getBdd()
    {
        if (self::$pdo === null) {
            self::setBdd();
        }
        return self::$pdo;
    }


    public static function sendJson($info)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        echo json_encode($info);
    }
}




















// try {
//     $pdo = new PDO('mysql:host=localhost;dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ]);
//     return $pdo;
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }
