<?php

namespace Model;

class Product extends Model
{
    private int $id;
    private string $name;
    private float $price;
    private string $image;

    public function __construct(int $id, string $name, float $price, string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    }

    public static function getAll(): null|array
    {
        $stmt = self::getPDO()->query("SELECT * FROM products");
        $products = $stmt->fetchAll();

        if (empty($products)) {
            return null;
        }

        $arr = [];
        foreach ($products as $product) {
            $arr[] = new self($product['id'], $product['name'], $product['price'], $product['image']);
        }
        return $arr;
    }

    public static function getAllById(int $id): array|null
    {
        $stmt = self::getPDO()->prepare("SELECT * FROM products WHERE id=:id");
        $stmt->execute(['id' => $id]);

        $allProducts = $stmt->fetchAll();

        if (empty($allProducts)) {
            return null;
        }

        $arr = [];
        foreach ($allProducts as $product) {
            $arr[] = new self($product['id'], $product['name'], $product['price'], $product['image']);
        }
        return $arr;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}