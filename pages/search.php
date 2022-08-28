<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["search"]) ? $_SESSION["search"] : [];

Template::header("Söksida"); ?>

<h2>Produkter som överensstämmer med din sökning:</h3>

<?php if ($_SESSION["search"]) : ?>

    <div id="product-details" hidden>
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
        </p>
    </div>

    
<?php
    
endforeach;
endif;
    
Template::footer();
    