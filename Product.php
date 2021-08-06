<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Product
{
    public string $name;
    public float $price;

    function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function formattedPrice()
    {
        return "€" . number_format($this->price, 2);
    }
}