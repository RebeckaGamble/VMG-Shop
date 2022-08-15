<?php
require_once __DIR__ . "/../classes/Template.php";


Template::header("Registrera användare");

?>


    <form action="/vmg/scripts/post-register-user.php" method="post">
        <input type="text" name="username" placeholder="Användarnamn"><br>
        <input type="password" name="password" placeholder="Lösenord"><br>
        <input type="password" name="confirm-password" placeholder="Upprepa Lösenord"><br>
        <input type="submit" value="Registrera">
    </form>

<?php

Template::footer();

?>