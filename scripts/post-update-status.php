<?php

require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/Order.php";

require_once __DIR__ . "/../admin-scripts/force-admin.php";

$success = false;

if (isset($_POST["id"]) && isset($_POST["status"])) {
    $orders_db = new OrdersDatabase();
    $success = $orders_db->update_status($_POST["id"], $_POST["status"]);
}
else {
    die("Function went wrong");
}
if ($success) {
    header("Location: /vmg/pages/admin-edit-status.php?id=" . $_POST["id"]);
}