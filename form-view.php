<?php // This files is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>PHP charms</title>
</head>
<body>
<div class="container">
    <h1>Place your order</h1>
    <?php if (!empty($confirmationMessage)) { ?>
            <?= $confirmationMessage ?>
    <?php }; ?>

    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" required="required" value="<?php echo $_SESSION["email"] ?? '' ?>">
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" required="required" value="<?php echo $_SESSION["street"] ?? '' ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" required="required" value="<?php echo $_SESSION["streetnumber"] ?? '' ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" required="required" value="<?php echo $_SESSION["city"] ?? '' ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="number" id="zipcode" name="zipcode" class="form-control" required="required"  value="<?php echo $_SESSION["zipcode"] ?? '' ?>">
                </div>
            </div>
        </fieldset>

        <?php // Navigation for when you need it ?>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active bg-primary text-white border" href="?PHP">Order PHP Charms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-primary text-white border ml-5" href="?JS">Order JS Charms</a>
                </li>
            </ul>
        </nav>


        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
					<?php // <?= is equal to <?php echo ?>
                    <input type="checkbox" value="1" <?php if(isset($_POST['products'][$i])) { foreach($_POST['products'] as $tmp) { if($tmp == "1") { echo "checked=\"checked\""; }}} ?> name="products[<?= $i ?>]"/> <?= $product->name ?> -
                    <?= $product->formattedPrice()?></label><br />
            <?php endforeach; ?>
        </fieldset>
        <fieldset>
            <legend>Delivery</legend>
            <input type="checkbox" value="1" name="delivery">
            <label for="delivery">Express Delivery - 5€</label>
        </fieldset>

        <button type="submit" name="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>
