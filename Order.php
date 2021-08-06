<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Order
{
    private string $email;
    private string $street;
    private string $streetNumber;
    private string $city;
    private string $zipcode;
    private array $orderedItems;

    function __construct($email, $street, $streetNumber, $city, $zipcode, $orderedItems)
    {
        $this->email = $email;
        $this->street = $street;
        $this->streetNumber=$streetNumber;
        $this->city=$city;
        $this->zipcode=$zipcode;
        $this->orderedItems=$orderedItems;
    }

    function delivery()
    {
        if(isset($_POST["delivery"])) {
            return "You selected Express Delivery. Your products will be delivered within 2 days.";
        } else {
            return "You selected Standard Delivery. Your products will be delivered within 5 days.";
        }
    }

    public function orderConfirmation()
    {
        $message = 'Your address: ' . $this->street . ' ' . $this->streetNumber . ', ' . $this->zipcode . ' ' . $this->city;
        $message .= '<br>';
        $message .= 'Your email: ' . $this->email;
        $message .= '<br>';
        $message .= '<br>';
        $message .= 'You have ordered the following products: <br>' . implode('<br>', $this->orderedItems);
        $message .= '<br>';
        $message .= '<br>';
        $message .= $this->delivery();

        return '<div class="alert alert-success"> ' . $message . '</div>';
    }


}