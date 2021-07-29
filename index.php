<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'PHP Novice - brown charm', 'price' => 100],
    ['name' => 'PHP Apprentice - yellow charm', 'price' => 500],
    ['name' => 'PHP Bodger - purple charm', 'price' => 1000],
    ['name' => 'PHP Journeyman - blue charm', 'price' => 5000],
    ['name' => 'PHP Scholar - green charm', 'price' => 10000],
    ['name' => 'PHP Master - red charm', 'price' => 20000],
    ['name' => 'PHP Grand Master - gold charm', 'price' => 50000],
    ['name' => 'PHP Legend - white charm', 'price' => 100000],
    ['name' => 'PHP God - black charm', 'price' => 500000],
];

$totalValue = 0;

function validate()
{
    // This function will send a list of invalid fields back
    return [];
}

function handleForm()
{
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

// TODO: replace this if by an actual check
$formSubmitted = false;
if ($formSubmitted) {
    handleForm();
}

require 'form-view.php';