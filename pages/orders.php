<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Product.php";

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

$products_db = new ProductsDatabase();
$products = $products_db->get_all();

$orders_db = new OrdersDatabase();
$orders = $orders_db->get_order_by_user_id($logged_in_user->id);

Template::header("Dina beställningar", "");
foreach ($orders as $order) : $order_products = $orders_db->get_products_by_order_id($order["id"]);
?>

    <h3> Order summary </h3>
    <?php foreach ($order_products as $product) : ?>
        <div>
            <img src="<?= $product["img_url"] ?>" height="50" width="50" alt="<?= $product["title"] ?>">
            <i> <?= $product["title"] ?> </i>
            <i> <?= $product["price"] ?> kr</i>
        </div>
    <?php endforeach ?>

    <p>
        <b> Status: <?= $product["status"] ?> </b>
    </p>

<?php endforeach ?>

<?php
Template::footer();
?>