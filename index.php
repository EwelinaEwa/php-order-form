<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require "orders.php";
require "products.php";


// We are going to use session variables so we need to enable sessions
session_start();



// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    echo('<pre>');
    var_dump($_POST);
    echo('</pre>');
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

whatIsHappening();

$product1 = new Product("PHP Novice - brown charm", 100);
$product2 = new Product("PHP Apprentice - yellow charm", 500);
$product3 = new Product("PHP Bodger - blue charm", 1000);
$product4 = new Product("PHP Journeyman - green charm", 5000);
$product5 = new Product("PHP Scholar - purple charm", 10000);
$product6 = new Product("PHP Master - red charm", 20000);
$product7 = new Product("PHP Grand Master - gold charm", 50000);
$product8 = new Product("PHP Legend - white charm", 100000);
$product9 = new Product("PHP God - black charm", 500000);
$product10 = new Product("JS Novice - brown charm", 100);
$product11 = new Product("JS Apprentice - yellow charm", 500);
$product12 = new Product("JS Bodger - blue charm", 1000);
$product13 = new Product("JS Journeyman - green charm", 5000);
$product14 = new Product("JS Scholar - purple charm", 10000);
$product15 = new Product("JS Master - red charm", 20000);
$product16 = new Product("JS Grand Master - gold charm", 50000);
$product17 = new Product("JS Legend - white charm", 100000);
$product18 = new Product("JS God - black charm", 500000);


$host = basename($_SERVER['REQUEST_URI']);
if($host == "?PHP=1") {

    $products = [
        $product1,
        $product2,
        $product3,
        $product4,
        $product5,
        $product6,
        $product7,
        $product8,
        $product9,
    ];

} else {

    $products = [
        $product10,
        $product11,
        $product12,
        $product13,
        $product14,
        $product15,
        $product16,
        $product17,
        $product18,
    ];
}

//var_dump($products);

$totalValue = 0;

function validate()
{
    $invalidFields = [];
    // This function will send a list of invalid fields back
    if (empty($_POST['email'])) {
        array_push($invalidFields, 'email');
    }
    if (empty($_POST['street'])) {
        array_push($invalidFields, 'street');
    }
    if (empty($_POST['streetnumber'])) {
        array_push($invalidFields, 'streetnumber');
    }
    if (empty($_POST['city'])) {
        array_push($invalidFields, 'city');
    }
    if (empty($_POST['zipcode'])) {
        array_push($invalidFields, 'zipcode');
    }
    if (!is_numeric($_POST['zipcode'])) {
        array_push($invalidFields, 'zipcodeInvalid');
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        array_push($invalidFields, 'emailInvalid');
    }
    return $invalidFields;
}

function handleForm($products)
{
    if(isset($_POST["submit"])) {
        $_SESSION["email"] = htmlentities($_POST['email']);
        $_SESSION["street"] = htmlentities($_POST['street']);
        $_SESSION["streetnumber"] = htmlentities($_POST['streetnumber']);
        $_SESSION["city"] = htmlentities($_POST['city']);
        $_SESSION["zipcode"] = htmlentities($_POST['zipcode']);
    };

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        if (in_array("email", $invalidFields)) {
            $errorMsg = 'Please fill in your E-mail.';
        }
        elseif (in_array("emailInvalid", $invalidFields)) {
            $errorMsg = "Invalid E-mail format.";
        }
        if (in_array("street", $invalidFields)) {
            $errorMsg .= '<br>';
            $errorMsg .= 'Please fill in your Street.';
        }
        if (in_array("streetnumber", $invalidFields)) {
            $errorMsg .= '<br>';
            $errorMsg .= 'Please fill in your Street number.';
        }
        if (in_array("city", $invalidFields)) {
            $errorMsg .= '<br>';
            $errorMsg .= 'Please fill in your City.';
        }
        if (in_array("zipcode", $invalidFields)) {
            $errorMsg .= '<br>';
            $errorMsg .= 'Please fill in your Zipcode.';
        }
        elseif (in_array("zipcodeInvalid", $invalidFields)) {
            $errorMsg .= '<br>';
            $errorMsg .= "Zipcode can only have numeric values.";
        }

        if (in_array("products", $invalidFields)) {
            $errorMsg .= '<br>';
            $errorMsg .= "Please select at least one product.";
        }

        return '<div class="alert alert-danger"> ' . $errorMsg . '</div>';
    } else {
        $productNames = [];

        $productNumbers = array_keys($_POST['products']);
        foreach ($productNumbers as $productNumber) {
            $productNames[] = $products[$productNumber]->name;
        }

        $order2021_001 = new Order($_POST['email'], $_POST['street'], $_POST['streetnumber'], $_POST['city'], $_POST['zipcode'], $productNames);
        echo $order2021_001->orderConfirmation();
    }
}


$formSubmitted = !empty($_POST);
$confirmationMessage = '';
if ($formSubmitted) {
    $confirmationMessage = handleForm($products);
}

//session_destroy();


require 'form-view.php';