<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/Product.php";

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

if (!$logged_in_user) {
    http_response_code(401);
    die("Access denied");
}

// $user = $_SESSION["user"];

// $orders_db = new Ordersdatabase();

// $orders = $orders_db->get_one_order($user->id);

Template::header("Your orders", "");

// foreach ($orders as $order) : 



?>