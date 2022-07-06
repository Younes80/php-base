<?php


$page = $_GET['page'] ?? '';

ob_start();

if ($page === "home") {
    require_once './views/home.php';
} elseif ($page === "contact") {
    require_once './views/contact.php';
} elseif ($page === "edit-fruit") {
    require_once './views/edit-fruit.php';
} elseif ($page === "delete-fruit") {
    require_once './views/delete-fruit.php';
}


$content = ob_get_clean();

require_once './views/common/template.php';
