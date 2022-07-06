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
        $error = "";
        $products = $this->productManager->getProducts();
        require_once './views/home.php';
    }

    public function setProduct()
    {
        $title = "PHP - Les bases (dans une variable)";
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            if (!$name) {
                $error = 'Champ à renseigner';
            }
            if (!$error) {
                $this->productManager->setProduct($name);
                header('Location: ' . $_SERVER['PHP_SELF']);
            }
        }
    }

    public function updateProduct()
    {
        $id = $_GET['id'] ?? '';

        if ($id) {
            $product = $this->productManager->getProduct($id);
            require_once './views/edit-fruit.php';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $this->productManager->updateProduct($name, $id);
            header('Location: index.php?page=back/home');
        }
    }

    public function deleteProduct()
    {

        $id = $_GET['id'];

        if ($id) {

            $this->productManager->deleteProduct($id);
            header('Location: index.php?page=back/home');
        }
    }
}
