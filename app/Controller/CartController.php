<?php


namespace Controller;

use Request\ProductRequest;
use Request\Request;
use Model\Cart;
use Model\CartProduct;
use Model\Product;


class CartController
{
        public function getAddProduct(): void
    {
        require_once '../View/main3.phtml';
    }
    public function postAddProduct(ProductRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            session_start();
            if (isset($_SESSION['user_id'])) {
                $requestData = $request->getBody();
                $userId = $_SESSION['user_id'];
                $productId = $requestData['product_id'];
                $quantity = $requestData['quantity'];


                $cart = Cart::getOneByUserId($userId);

                if (empty($cart)) {
                    Cart::create($userId);

                    $cart = Cart::getOneByUserId($userId);
                }

                CartProduct::create($cart->getId(), $productId, $quantity);

                header('location: /main');
            }
        }
    }

}