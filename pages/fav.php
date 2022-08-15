<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["fav"]) ? $_SESSION["fav"] : [];

Template::header("Favoriter"); ?>

<h3>Mina favoriter</h3>


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
        
            <button data-id="<?= $product->id ?>" class="show-product-details">Visa</button>
        
            <form action="/vmg/scripts/post-add-to-cart.php" method="post">
                <input type="hidden" name="product-id" value="<?= $product->id ?>">
                <input type="submit" value="Lägg i kundvagn">
            </form>
            <hr>
        </p>
    </div>

   

    
<?php
    
endforeach;
    
Template::footer();
    