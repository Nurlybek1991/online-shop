<?php

$reguestUri = $_SERVER['REQUEST_URI'];


if($reguestUri === '/registrate') {
    require_once './handler/registrate.php';
} elseif ($reguestUri === '/login') {
    require_once './handler/login.php';
} elseif ($reguestUri === '/main') {
    require_once './handler/main.php';
} elseif ($reguestUri === '/add-product') {
    require_once './handler/add-product.php';
} else {
    require_once './html/404.html';
}