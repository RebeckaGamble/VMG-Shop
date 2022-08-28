<?php


require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Product.php";

session_start(); 

$is_logged_in = isset($_SESSION['user']);
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

if (!$cart) {
    header("Location: /vmg/pages/cart.php");
}

// Om det finns något i korgen samt är inloggad, då kan man lägga en order. // Färdig till rad 33.
if ($is_logged_in && count($cart) > 0) {
    
    // Lägga in orders = pages/orders.php + `orders`
    $order = new Order($logged_in_user->id, "waiting", date("Y-m-d"));
    $db_orders = new OrdersDatabase();

    $order_id = $db_orders->create_order_to_orders($order);
        if ($order_id == false) {
            die("Error creating order, please sign in first");
        }

    // Lägga in `OrderProducts`  
    foreach ($cart as $product) {
        $success = $db_orders->create_order_to_order_products($order_id, $product->id);
    }

    if ($success) {
        unset($_SESSION['cart']);
        header("Location: /vmg/pages/orders.php");
        die();

    } else {
    die("Couldn't add to OrderProducts");
    }
} else {
    die("invalid cart / user");
}