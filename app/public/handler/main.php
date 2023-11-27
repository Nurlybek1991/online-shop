<?php

session_start();
if (isset($_SESSION['user_id'])) {

    $pdo = new PDO("pgsql:host=db;dbname=postgres", "dbuser", "dbpwd");

    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll();

} else {
    header('location: /login');
}

require_once './html/main.phtml';


