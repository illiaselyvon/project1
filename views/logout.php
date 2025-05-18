<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Controller/ProductController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = new \App\Controller\ProductController();
$controller->getUserModel()->logout();

header('Location: login.php');
exit;
?>