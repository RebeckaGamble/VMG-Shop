<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Product.php";

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401);
    die("Access denied");
}

if (!isset($_GET["id"])) {
    die("Invalid input");
}

$products_db = new ProductsDatabase();

$product = $products_db->get_one($_GET["id"]);

//if ($product == null) {
//    die ("No product!");
//}

Template::header("Update product"); ?>

    <form action="/vmg/admin-scripts/post-update-product.php" enctype="multipart/form-data">
        <div> <img src="<?= $product->img_url ?>" alt=""> <br> </div>
        <input type="text name="title" placeholder="Title" value="<?= $product->title?>"> <br>
        <textarea name="description" placeholder="Description"><?= $product->description ?></textarea>
        <input type="number" name="price" placeholder="Price" value="<?= $product->price ?>"> <br>
        <input type="file" name="image" accept="image/*"> <br>
        <input type="submit" value=" Update & Save">
        <a href="/vmg/pages/admin.php">Back to products</a>
    </form>

    <p>
        <b>Delete:</b>
    </p>
    <form action="/vmg/admin-scripts/post-delete-product.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?> ">
        <input type="submit" value="Delete product">
    </form>

<?php

Template::footer();
