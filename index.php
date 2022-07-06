<?php


define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once './controllers/product/Product.controller.php';
require_once './controllers/api/Api.controller.php';
$productController = new ProductController();
$apiController = new ApiController();

$page = $_GET['page'] ?? '';
$id = $_GET['id'] ?? '';
if (empty($page)) {
    header('Location: back/home');
}

$url = explode("/", filter_var($page, FILTER_SANITIZE_URL));

if ($url[0] === "back") {
    ob_start();
    if ($url[1] === 'home') {
        $productController->getProducts();
    } elseif ($url[1] === "contact") {
        require_once './views/contact.php';
    } elseif ($url[1] === "create-product") {
        $productController->setProduct();
    } elseif ($url[1] === "update-product") {
        $productController->setProduct();
    } elseif ($url[1] === "delete-product") {
        $productController->deleteProduct();
    }
    $content = ob_get_clean();
    require_once './views/common/template.php';
} elseif ($url[0] === 'api') {
    if ($url[1] === 'getProducts') {
        $apiController->getProducts();
    } elseif ($url[1] === 'setProduct') {
        $apiController->setProduct();
    } elseif ($url[1] === 'updateProduct') {
        $apiController->updateProduct();
    } elseif ($url[1] === 'deleteProduct') {
        $apiController->deleteProduct();
    }
}
