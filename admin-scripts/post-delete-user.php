<?php

require_once __DIR__ . "/force-admin.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$success = false;

if (isset($_POST["id"])) {
    $users_db = new UsersDatabase();

    $success = $users_db->delete($_POST["id"]);
} else {
    die("Invalid input!");
}

if ($success) {
    header("Location: /vmg/pages/admin.php");
} else {
    die("Error deleting user!");
}
