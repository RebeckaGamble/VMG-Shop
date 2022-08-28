<?php
require_once __DIR__ . "/classes/ProductsDatabase.php";
require_once __DIR__ . "/classes/Template.php";

$products_db = new ProductsDatabase();
$products = $products_db->get_all();

Template::header("VMG SHOP "); ?>

<!-- PRODUKTER -->
<h2 class="page-title">Produkter</h2>
<main class="products-grid">
    <?php foreach ($products as $product) :  ?>
        <article class="product">
            <img src="<?= $product->img_url ?>" alt="Product image" class="product-image">
            <div class="product-info">
                <b><?= $product->title ?></b>
                <i><?= $product->price ?> kr</i>
                <p><?= $product->description ?></p>
            </div>
            <!--Kundvagn-->
            <div class="shop-btn">
                <form action="/vmg/scripts/post-add-to-cart.php" method="post">
                    <input type="hidden" name="product-id" value="<?= $product->id ?>">
                    <input type="submit" value="Lägg i kundvagn" class="btn">
                </form>
                <!--Favorit-->
                <form action="/vmg/scripts/post-add-to-fav.php" method="post">
                    <input type="hidden" name="product-id" value="<?= $product->id ?>">
                    <input type="submit" value="Spara som favorit" class="btn">
                </form>
            </div>
        </article>
    <?php endforeach; ?>
    </main>
    
    
<?php


Template::footer();
