<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";


$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401);
    die("Obehörig!");
}

$products_db = new ProductsDatabase();
$users_db = new UsersDatabase();
$orders_db = new OrdersDatabase();

$users = $users_db->get_all();
$products = $products_db->get_all();
$orders = $orders_db->get_all_orders();

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

<h2>Create user</h2>

<form action="/vmg/admin-scripts/post-create-user.php" method="post" enctype="multipart/form-data">
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="text" name="password" placeholder="Password"> <br>
    <select name="role" id="role">
        <option value="role" selected disabled>Role</option>
        <option value="admin">Admin</option>
        <option value="customer">Användare</option>
    </select>
    <br>
    <input type="submit" name="Save user">
</form>

<hr>

<h2>Produkter</h2>

<?php foreach ($products as $product) : ?>
    <p>
        <a href="/vmg/pages/admin-product-update.php?id=<?= $product->id ?>">
            <?= $product->title ?>
        </a>
    </p>
<?php endforeach; ?>

<hr>

<h2>Användare</h2>

<?php foreach ($users as $user) : ?>
    <p>
        <a href="/vmg/pages/admin-edit-user.php?id=<?= $user->id ?>">
            <?= $user->username ?>
            <i><?= $user->role ?></i>
        </a>
    </p>
<?php endforeach; ?>

<hr>

<h2>Customer Orders</h2>
<?php foreach ($orders as $order) : ?>
    <p>
        <a href="/vmg/pages/admin-edit-status.php?id=<?= $order->id ?>">
        Order: <?= $order->id ?> 
        </a> <br>

        <i> User # <?= $order->user_id ?> </i> <br>
        <i> Status: </i><?= $order->status ?> </i> <br>
        <i> Date: <?= $order->order_date ?> </i>
    </p>
<?php endforeach; ?>

<?php

Template::footer();
