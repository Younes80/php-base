<?php

namespace controllers\api;

use models\Database;
use models\product\ProductManager;

// require_once './models/product/Product.manager.php';
// require_once './models/Database.php';

class ApiController
{

    private $productManager;

    public function __construct()
    {
        $this->productManager = new ProductManager();
    }

    public function getProducts()
    {
        $products = $this->productManager->getProducts();
        Database::sendJson($products);
    }


    public function setProduct()
    {
        $error = "";
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data['name']) {
            $error = 'Champ à renseigner';
            Database::sendJson($error);
        }
        if (!$error) {
            $this->productManager->setProduct($data['name']);
        }
    }

    public function updateProduct()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $name = $data['name'];
        $this->productManager->updateProduct($name, $id);
    }

    public function deleteProduct()
    {

        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $this->productManager->deleteProduct($id);
    }
}
