<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";


$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if(!$is_admin) {
    http_response_code(401); 
    die("Obehörig!");
}

$products_db = new ProductsDatabase();
$users_db = new UsersDatabase();

$users = $users_db->get_all();
$products = $products_db->get_all();

Template::header("Admin sida"); 

?>

<h2>Skapa produkt</h2>

<form action="/vmg/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Titel"> <br>
    <textarea name="description" placeholder="Beskrivning"></textarea> <br>
    <input type="number" name="price" placeholder="Pris"> <br>
    <input type="file" name="image" accept="image/*"> <br>
    <input type="submit" value="Spara">
</form>

<hr>

<h2>Produkter</h2>

<?php foreach($products as $product): ?>
    <p>
        <a href="/vmg/pages/admin-product.php?id=<?= $product->id ?>">
            <?= $product->title ?>
        </a>
    </p>
<?php endforeach; ?>

<hr>

<h2>Användare</h2>

<?php foreach($users as $user): ?>

    <p>
        <a href="/vmg/pages/admin-user.php?id=<?= $user->id ?>">
        <?= $user->username ?>
        <i><?= $user->role ?></i>
        </a>
    </p>
<?php endforeach; ?>

<?php

Template::footer();