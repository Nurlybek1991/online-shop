<?php

use Controller\CartController;
use Controller\UserController;
use Controller\MainController;
use Request\LoginRequest;
use Request\RegistrateRequest;
use Request\Request;

$autoload = function (string $classname) {
    $path = str_replace('\\', '/', $classname);
    $path = dirname(__DIR__) . "/" . $path . ".php";

    if (file_exists($path)) {
        require_once $path;
    }
};

spl_autoload_register($autoload);

$routes = [
    '/login' => [
        'GET' => [
            'class' => UserController::class,
            'method' => 'getLogin',
        ],
        'POST' => [
            'class' => UserController::class,
            'method' => 'postLogin',
            'request' => LoginRequest::class
        ]
    ],
    '/registrate' => [
        'GET' => [
            'class' => UserController::class,
            'method' => 'getRegistrate',
        ],
        'POST' => [
            'class' => UserController::class,
            'method' => 'postRegistrate',
            'request' => RegistrateRequest::class
        ]
    ],
    '/main' => [
        'GET' => [
            'class' => MainController::class,
            'method' => 'getMain',
        ],
        'POST' => [
            'class' => MainController::class,
            'method' => 'postMain',
        ]
    ],
    '/addProduct' => [
        'GET' => [
            'class' => CartController::class,
            'method' => 'getAddProduct'
        ],
        'POST' => [
            'class' => CartController::class,
            'method' => 'postAddProduct'
        ]
    ],
    '/cart' => [
        'GET' => [
            'class' => CartController::class,
            'method' => 'getUserCart'
        ]
    ]
];
$requestUri = $_SERVER['REQUEST_URI'];
if (isset($routes[$requestUri])) {
    $routeMethods = $routes[$requestUri];
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    if (isset($routeMethods[$requestMethod])) {
        $handler = $routeMethods[$requestMethod];
        $class = $handler['class'];
        $method = $handler['method'];

        if (isset($handler['request'])) {
            $requestClass = $handler['request'];
            $request = new $requestClass($requestMethod, $_POST);
        } else {
            $request = new Request($requestMethod, $_POST);
        }

        $obj = new $class();
        $obj->$method($request);
    } else {
        echo "Метод $requestMethod для $requestUri не поддерживается";
    }

} else {
    require_once '../View/404.html';
}
