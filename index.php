<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


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

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'PHP Novice - brown charm', 'price' => 100],
    ['name' => 'PHP Apprentice - yellow charm', 'price' => 500],
    ['name' => 'PHP Bodger - blue charm', 'price' => 1000],
    ['name' => 'PHP Journeyman - green charm', 'price' => 5000],
    ['name' => 'PHP Scholar - purple charm', 'price' => 10000],
    ['name' => 'PHP Master - red charm', 'price' => 20000],
    ['name' => 'PHP Grand Master - gold charm', 'price' => 50000],
    ['name' => 'PHP Legend - white charm', 'price' => 100000],
    ['name' => 'PHP God - black charm', 'price' => 500000],
];

$totalValue = 0;

function validate()
{
    $emptyFields = [];
    // This function will send a list of invalid fields back
    if (empty($_POST['email'])) {
        array_push($emptyFields, 'email');
    }
    if (empty($_POST['street'])) {
        array_push($emptyFields, 'street');
    }
    if (empty($_POST['streetnumber'])) {
        array_push($emptyFields, 'streetnumber');
    }
    if (empty($_POST['city'])) {
        array_push($emptyFields, 'city');
    }
    if (empty($_POST['zipcode'])) {
        array_push($emptyFields, 'zipcode');
    }
    var_dump($emptyFields);
    return $emptyFields;
}

function handleForm()
{
    // TODO: form related tasks (step 1)

    $productNumbers = array_keys($_POST['products']);
    $productNames = [];
    foreach ($productNumbers as $productNumber) {
        $productNames[] = $products[$productNumber]['name'];
    }

    $message = 'Your address: ' . $_POST['street'] . ' ' . $_POST['streetnumber'] . ', ' . $_POST['zipcode'] . ' ' . $_POST['city'];
    $message .= '<br>';
    $message .= 'Your email: ' . $_POST['email'];
    $message .= '<br>';
    $message .= '<br>';
    $message .= 'You have ordered the following products: <br>' . implode('<br>', $productNames);



    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        if (in_array("email", $invalidFields)) {
            $message = 'Please fill in your E-mail.';
        }
        if (in_array("street", $invalidFields)) {
            $message .= '<br>';
            $message .= 'Please fill in your Street.';
        }
        if (in_array("streetnumber", $invalidFields)) {
            $message .= '<br>';
            $message .= 'Please fill in your Street number.';
        }
        if (in_array("city", $invalidFields)) {
            $message .= '<br>';
            $message .= 'Please fill in your City.';
        }
        if (in_array("zipcode", $invalidFields)) {
            $message .= '<br>';
            $message .= 'Please fill in your Zipcode.';
        }
        return $message;
    } else {
        // TODO: handle successful submission
        return $message;
    }
}

// TODO: replace this if by an actual check
$formSubmitted = !empty($_POST);
$confirmationMessage = '';
if ($formSubmitted) {
    $confirmationMessage = handleForm($products);
}

require 'form-view.php';