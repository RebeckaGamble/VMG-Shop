<?php

require_once __DIR__ . "/../classes/UsersDatabase.php";

if(isset($_POST["username"]) && isset($_POST["password"])) {

    $users_db = new UsersDatabase();

    $user = $users_db->get_one_by_username($_POST["username"]);

    if ($user && $user->test_password($_POST["password"])) {

        session_start();

        $_SESSION["user"] = $user;

        header("Location: /vmg");
    }   
    else {
        header("Location: /vmg/pages/login.php?error=wrong_pass");
        die();
        //die("Ogiltigt användarnamn eller lösenord!");
    }
}
else {
    die("Ogiltig input!");
}