<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Template.php";

$products_db = new ProductsDatabase();

$products = $products_db->get_all();

Template::header("Produkter"); ?>

<div class="grid-container">

    <?php foreach ($products as $product) : ?>

        <div class="card">
            <img class="product-image" src="<?= $product->img_url ?>" alt="Product image" class="product-image">
            <div class="product-description">
                <b class="product-title"><?= $product->title ?></b> <br>
                <i><?= $product->price ?> kr</i>
            </div> <br>

            <div class="form">
                <form action="/vmg/scripts/post-add-to-cart.php" method="post">
                    <input type="hidden" name="product-id" value="<?= $product->id ?>">
                    <input type="submit" class="cart-btn" value="Lägg i kundvagn">
                </form> <br>
                <form action="/vmg/scripts/post-add-to-fav.php" method="post">
                    <input type="hidden" name="product-id" value="<?= $product->id ?>">
                    <input type="submit" class="addfav-btn" value="Spara i favoriter">
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?
Template::footer();
