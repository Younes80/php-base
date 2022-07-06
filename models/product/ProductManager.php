<?php

namespace models\product;

use models\Database;

// require_once 'models/Database.php';

class ProductManager extends Database
{

    public function getProducts()
    {
        $req = "SELECT * FROM product";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $stmt->closeCursor();
        return $products;
    }


    public function getProduct($id)
    {
        $req = "SELECT * FROM product WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch();
        $stmt->closeCursor();
        return $product;
    }

    public function setProduct($name)
    {
        $req = "INSERT INTO product VALUES (DEFAULT, :name, :user_id)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":user_id", 1);
        $stmt->execute();
    }

    public function updateProduct($name, $id)
    {
        $req = "UPDATE product SET name = :name WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $req = "DELETE FROM product WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }
}
