<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

Template::header("VMG SHOP"); ?>

<h2 class="page-title">Varukorg</h2>

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

    <div class="products-grid-cart">
        <?php foreach ($products as $product) : ?>


            <article class="product-cart">
                <img src="<?= $product->img_url ?>" alt="Product image" class="product-image-cart">
                <b class="cart-text-box"><?= $product->title ?></b>
                <i class="cart-text-box"><?= $product->price ?> kr</i>
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
                <a href="vmg/scripts/delete-from-cart.php" class="cart-text-box">Delete</a>
                <!-- <button data-id="<?= $product->id ?>" class="show-product-details">Show</button> -->
            </article>


        <?php endforeach ?>
    </div>
    <a href="/vmg/pages/orders.php">Checkout</a>
<?php endif ?>

<?php
Template::footer();
