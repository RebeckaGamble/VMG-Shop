<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["fav"]) ? $_SESSION["fav"] : [];

Template::header("VMG SHOP"); ?>

<h2 class="page-title">Mina favoriter</h2>

<?php if (!$products) : ?>
    <h3 style="color: gray">Inga favoriter sparade</h2>
    <a href="/vmg/index.php">Gå till produkter</a>
<?php endif; ?>

<div id="product-details" hidden>
    <img src="" id="product-img" class="product-image">
    <p id="product-title"></p>
    <p id="product-description"></p>
    <p id="product-price"></p>
</div>


<div class="products-grid">
    <?php foreach ($products as $product) : ?>


        <article class="product">
            <p>
                <img src="<?= $product->img_url ?>" alt="Product image" class="product-image">
            <div class="product-info">
                <b><?= $product->title ?></b>
                <i><?= $product->price ?> kr</i>
                <p><?= $product->description ?></p>
            </div>

            <form action="/vmg/scripts/post-add-to-cart.php" method="post">
                <input type="hidden" name="product-id" value="<?= $product->id ?>">
                <input type="submit" value="Lägg i kundvagn" class="btn">
            </form>
            <hr>
            </p>
        </article>
    <?php endforeach; ?>
</div>

<?php
Template::footer();