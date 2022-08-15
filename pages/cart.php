<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

Template::header("Kundvagn"); ?>

<h3>Varukorg</h3>

<?php if (!$products) : ?>
    <h2>Cart is empty</h2>
    <a href="/vmg/pages/products.php">Go to products</a>

<?php elseif ($_SESSION["cart"]) : ?>
    <div id="product-details" hidden>
        <img src="" id="product-img" height="50" width="50">
        <p id="product-title"></p>
        <p id="product-description"></p>
        <p id="product-price"></p>
    </div>


    <?php foreach ($products as $product) : ?>

        <div>
            <img src="<?= $product->img_url ?>" width="50" height="50" alt="Product image">
            <b><?= $product->title ?></b>
            <i><?= $product->price ?> kr</i>
            <select name="quantity" id="<?= $_GET["id"] ?>">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <a href="vmg/scripts/delete-from-cart.php">Delete</a>
            <!-- <button data-id="<?= $product->id ?>" class="show-product-details">Show</button> -->
        </div>

    <?php endforeach ?>
    <a href="/vmg/pages/orders.php">Checkout</a>
<?php endif ?>

<?php
Template::footer();
