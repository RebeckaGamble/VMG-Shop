<?php

require_once __DIR__ . "/force-admin.php";
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/User.php";

$success = false;

if (
    isset($_POST["username"]) && 
    isset($_POST["password"]) && 
    isset($_POST["role"]) &&

    strlen($_POST["username"]) > 0 &&
    strlen($_POST["password"]) > 0 &&   

    $_POST["password"] == $_POST["password"]
) {
    $users_db = new UsersDatabase();

    $user = new User($_POST["username"], $_POST["role"]);

    $user->hash_password($_POST["password"]);

    $existing_user = $users_db->get_one_by_username($_POST["username"]);

    if ($existing_user) {
        die("Username is taken");
    }
    else {
       $success = $users_db->create($user);
    }
}
else {
    die("Invalid input");
}

if ($success) {
    header ("Location: /vmg/pages/admin.php");
}
else {
    die("Error saving user");
}



Template::header("Create user");
?>