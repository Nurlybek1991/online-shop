<?php

namespace Request;

class ProductRequest extends Request
{
    function validate(): array
    {

        $errors = [];

        if (isset($this->body['product_id'])) {
            $productId = $this->body['product_id'];
            if ($productId < 0) {
                $errors['product_id'] = 'Товар должен быть больше 0';
            }
        } else {
            $errors['product_id'] = 'Введите номер Товара';
        }

        if (isset($this->body['quantity'])) {
            $quantity = $this->body['quantity'];
            if ($quantity < 0) {
                $errors['quantity'] = 'Количество товара должна быть больше 0';
            }
        } else {
            $errors['quantity'] = 'Введите  количество товара';
        }

        return $errors;
    }
}
