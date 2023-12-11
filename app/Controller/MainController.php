<?php

namespace Controller;

use Model\Product;

class MainController
{
    public function getMain(): void
    {
        require_once '../View/main.phtml';
    }
    public function postMain(): void
    {
        session_start();
        if (isset($_SESSION['user_id'])) {

            $products = Product::getAll();
        } else {
            header('location: /login');
        }

        require_once '../View/main.phtml';
    }
}