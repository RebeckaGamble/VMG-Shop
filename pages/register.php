<?php
require_once __DIR__ . "/../classes/Template.php";


Template::header("VMG SHOP");

?>

<h2 class="page-title">Registrera användare</h2>
    <form action="/vmg/scripts/post-register-user.php" method="post" class="form-user">
        <input type="text" name="username" placeholder="Användarnamn"><br>
        <input type="password" name="password" placeholder="Lösenord"><br>
        <input type="password" name="confirm-password" placeholder="Upprepa Lösenord"><br>
        <input type="submit" value="Registrera" class="btn-form">
    </form>

<?php

Template::footer();

?>