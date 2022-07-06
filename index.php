<?php

use controllers\api\ApiController;
use controllers\product\ProductController;
// require_once './controllers/product/Product.controller.php';
// require_once './controllers/api/Api.controller.php';

function autoload($class)
{
    require_once "$class.php";
}
spl_autoload_register("autoload");

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

$productController = new ProductController();
$apiController = new ApiController();

$page = $_GET['page'] ?? '';

try {
    if (empty($page)) {
        header('Location: back/home');
    } else {
        $url = explode("/", filter_var($page, FILTER_SANITIZE_URL));
        if (empty($url[0]) || empty($url[1])) throw new Exception("La page n'existe pas");
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
            } else {
                throw new Exception("La page n'existe pas");
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
            } else {
                throw new Exception("La page n'existe pas");
            }
        }
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}
