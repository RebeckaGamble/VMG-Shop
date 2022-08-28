<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401);
    die("Obehörig!");
}

$products_db = new ProductsDatabase();
$orders_db = new OrdersDatabase();

$products = $products_db->get_all();
$db_orders = $orders_db->get_order_by_order_id($_GET["id"]);
$products = $orders_db->get_products_by_order_id($_GET["id"]);

Template::header("Change status on order: {$_GET["id"]}", "");
?>

<u><b>Order: <?= $db_orders->id ?> </b></u>

<?php foreach ($products as $product) : ?>
    <div>
        <p>
            <?= $product["title"] ?>
            <?= $product["price"] ?>
        </p>
    </div>
<? endforeach ?>

<!-- Order info + produkter i beställningen -->
<p>

    <i> Status: <?= $db_orders->status ?></i> <br>
    <i> Order date: <?= $db_orders->order_date ?></i>

</p>


<form action="/vmg/scripts/post-update-status.php" method="POST">
    <input type="hidden" name="id" value="<?= $db_orders->id ?>">
    <select name="status" id="status">
        <option disabled selected>Status</option>
        <option value="waiting">waiting</option>
        <option value="sent">sent</option>
        <input type="submit" value="Update">
    </select>

</form>


<?php
Template::footer();
