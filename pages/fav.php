<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["fav"]) ? $_SESSION["fav"] : [];

Template::header("Favoriter"); ?>

<h2>Mina favoriter</h2>

<?php if (!$products) : ?>
    <h3 style="color: gray">Inga favoriter sparade</h2>
    <a href="/vmg/index.php">Gå till produkter</a>

    <?php elseif ($_SESSION["fav"]) : ?>

    <div id="product-details" hidden>
        <img src="" id="product-img" height="50" width="50">
        <p id="product-title"></p>
        <p id="product-description"></p>
        <p id="product-price"></p>
    </div>

<?php foreach ($products as $product): ?>

    <div>
        <p>
            <img src="<?= $product->img_url ?>" width="50" height="50" alt="Product image">
            <b><?= $product->title ?></b>
            <i><?= $product->price ?> kr</i>
            <i><?= $product->description ?></i>
        
            <form action="/vmg/scripts/post-add-to-cart.php" method="post">
                <input type="hidden" name="product-id" value="<?= $product->id ?>">
                <input type="submit" value="Lägg i kundvagn">
            </form>
            <hr>
        </p>
    </div>

<?php
    
endforeach;
endif;
    
Template::footer();
    