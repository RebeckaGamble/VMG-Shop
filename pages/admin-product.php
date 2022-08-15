<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Product.php";

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401);
    die("Tillträde nekas");
}

if (!isset($_GET["id"])) {
    die("Ogiltig input");
}

$products_db = new ProductsDatabase();

$product = $products_db->get_one($_GET["id"]);

//if ($product == null) {
//    die ("No product!");
//}

Template::header("Uppdatera produkt");

if ($product == null) : ?>

    <h2>Inga produkter</h2>

<?php else : ?>

<form action="/vmg/admin-scripts/post-update-product.php?id=<?= $_GET["id"] ?>" enctype="multipart/form-data">
    <img src="<?= $product->img_url ?>" alt=""> <br>
    <input type="text" name="title" placeholder="Titel" value="<?= $product->title?>"> <br>
    <textarea name="description" placeholder="Beskrivning"><?= $product->description ?></textarea>
    <input type="number" name="price" placeholder="Pris" value="<?= $product->price ?>"> <br>
    <input type="file" name="image" accept="image/*"> <br>
    <input type="submit" value="Spara">
    <a href="/vmg/pages/admin.php">Tillbaka till produkter</a>
</form>

<p>
    <b>Ta bort:</b>
</p>
<form action="/vmg/admin-scripts/post-delete-product.php" method="post">
    <input type="hidden" name="id" value="<?= $_GET["id"] ?> ">
    <input type="submit" value="Ta bort produkt">
</form>

<?php
endif ?>
Template::footer();