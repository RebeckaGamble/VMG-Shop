<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../admin-scripts/post-create-user.php";

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

$username = $_GET["username"];
$id = $_GET["id"];


$db = new UsersDatabase();

$user = $db->get_one_by_username($username);

Template::header("Create User");
?>

<form action="/vmg/admin-scripts/post-create-user.php" method="post">
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="text" name="password" placeholder="Password"> <br>
    <select name="role" id="role">
        <option value="role" selected disabled>Role</option>
        <option value="admin">Admin</option>
        <option value="customer">Customer</option>
    </select>
    <br>
    <input type="submit" name="Save user">
</form>