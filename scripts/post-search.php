<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Template.php";


if (isset($_POST['search'] )) {
    $products_db = new ProductsDatabase();
    $product = $products_db->search($_POST["search"]);

    if ($product) {
        $_SESSION["search"] = $product;

        header("Location: /vmg/pages/search.php");
        die();
    }
     if (!$product) : ?>
        <?php Template::header("Inga produkter"); ?>

        <h3 style="color: gray">Tyvärr hittade vi inga produkter som matchade med din sökning!</h2>
        <a href="/vmg/index.php">Gå till startsidan</a>

        <?php Template::footer(); ?>
    <?php 
    endif;
    
} 