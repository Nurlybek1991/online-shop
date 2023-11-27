<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST') {
    function validate(array $data) {

        $errors = [];

        if(isset($data['product-id'])) {
            $productId = $data['product-id'];
            if ($productId < 0) {
                $errors['product-id'] = 'Product-id должна быть больше 0';
            }
        }  else {
            $errors['product-id'] = 'Введите номер Product-id';
        }

        if(isset($data['quantity'])) {
            $quantity = $data['quantity'];
            if ($quantity < 0) {
                $errors['quantity'] = 'Количество товара должна быть больше 0';
            }
        } else {
            $errors['quantity'] = 'Введите  количество товара';
        }

        return $errors;
    }

    $errors = validate($_POST);

    if (empty($errors)) {
        $productId = $_POST['product-id'];
        $quantity = $_POST['quantity'];


        $pdo = new PDO("pgsql:host=db;dbname=postgres", "dbuser", "dbpwd");
        $stmt = $pdo->prepare("INSERT INTO cart_product (product-id, quantity) VALUES (:product-id, :quantity)");
        $stmt->execute(['product-id' => $productId, 'quantity' => $quantity]);

        $stmt = $pdo->prepare("SELECT * FROM cart_product");
        $stmt->execute();
        $data = $stmt->fetchAll();
        header('location: /main');
    }
}




require_once './html/add-product.phtml';
