<?php

namespace Model;

class CartProduct extends Model
{
    private int $id;
    private int $cartId;
    private int $productId;
    private int $quantity;

    public function __construct(int $id, int $cartId, int $productId, int $quantity)
    {
        $this->id = $id;
        $this->cartId = $cartId;
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public static function create(int $cartId, int $productId, int $quantity): void
    {
        $stmt = self::getPDO()->prepare("INSERT INTO cart_products (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)");
        $stmt->execute(['cart_id' => $cartId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public static function getAllByCartId(int $cartId): ?array
    {
        $stmt = self::getPDO()->prepare("SELECT * FROM cart_products WHERE cart_id=:cart_id");
        $stmt->execute(['cart_id' => $cartId]);

        $allData = $stmt->fetchAll();

        if (empty($datas)) {
            return null;
        }

        $arr = [];
        foreach ($allData as $data) {
            $arr[] = new self($data['id'], $data['cart_id'], $data['product_id'], $data['quantity']);
        }
        return $arr;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCartId(): int
    {
        return $this->cartId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}