<?php

require_once './models/product/Product.manager.php';

class ProductController
{

    private $productManager;

    public function __construct()
    {
        $this->productManager = new ProductManager();
    }

    public function getProducts()
    {
        $id = $_GET['id'] ?? '';
        $error = "";
        $products = $this->productManager->getProducts();
        if ($id) {
            $product = $this->productManager->getProduct($id);
            require_once './views/home.php';
        }
        require_once './views/home.php';
    }

    public function setProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $id = $_POST['id'] ?? '';

            if ($id) {
                $this->productManager->updateProduct($name, $id);
                header('Location: home');
            } else {
                if (!$name) {
                    $error = 'Champ à renseigner';
                    $products = $this->productManager->getProducts();
                    require_once './views/home.php';
                }
                if (!$error) {
                    $this->productManager->setProduct($name);
                    header('Location: home');
                }
            }
        }
    }

    public function deleteProduct()
    {
        $id = $_GET['id'];
        if ($id) {
            $this->productManager->deleteProduct($id);
            header('Location: home');
        }
    }
}
