<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require "Order.php";
require "Product.php";
require "product-list.php";


// We are going to use session variables so we need to enable sessions
session_start();


// Use this function when you need to need an overview of these variables
//function whatIsHappening() {
//    echo '<h2>$_GET</h2>';
//    var_dump($_GET);
//    echo '<h2>$_POST</h2>';
//    echo('<pre>');
//    var_dump($_POST);
//    echo('</pre>');
//    echo '<h2>$_COOKIE</h2>';
//    var_dump($_COOKIE);
//    echo '<h2>$_SESSION</h2>';
//    var_dump($_SESSION);
//}
//
//whatIsHappening();


$host = basename($_SERVER['REQUEST_URI']);
if($host == "?PHP" || $host == "php-order-form") {

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