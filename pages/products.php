<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Template.php";

$products_db = new ProductsDatabase();

$products = $products_db->get_all();

Template::header("Produkter");

foreach($products as $product): ?>

<div class="product">
    <img src="<?= $product->img_url ?>" alt="Product image" class="product-image">
    <b><?= $product->title ?></b>
    <i><?= $product->price ?> kr</i>
    <p><?= $product->description ?></p>
    

    <form action="/vmg/scripts/post-add-to-cart.php" method="post">
        <input type="hidden" name="product-id" value="<?= $product->id ?>">
        <input type="submit" value="Lägg i kundvagn">
    </form>
    <form action="/vmg/scripts/post-add-to-fav.php" method="post">
        <input type="hidden" name="product-id" value="<?= $product->id ?>">

        <input type="submit" value="Spara i favoriter">
    </form>
    
</div>

<?php

endforeach;

Template::footer();