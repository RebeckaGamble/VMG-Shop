<?php

//ladda in klasser

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

session_start();

//hämta produkten som klickas på
if (isset($_POST["product-id"])) {
    $products_db = new ProductsDatabase();
    $product = $products_db->get_one($_POST["product-id"]);

    //skapa varukorg om inte finns
    if(!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    //lägg produkt i varukorg
    if ($product) {
        $_SESSION["cart"][] = $product;

        header("Location: /vmg/index.php");
        die();
    }
}
else {
    die("Ogiltig input");
}

die("Kunde inte lägga till produkt i kundvagn!");

