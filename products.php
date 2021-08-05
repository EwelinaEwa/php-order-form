<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Product
{
    private string $name;
    private int $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}