<?php

require_once __DIR__ . "/../classes/Template.php";

Template::header("Logga in");

if(isset($_GET["error"]) && $_GET["error"] == "wrong_pass"): ?> 
    <h2>Fel användarnamn eller lösenord!</h2>
<?php endif; ?>


<form action="/vmg/scripts/post-login.php" method="post">
    <input type="text" name="username" placeholder="Användarnamn"> <br>
    <input type="password" name="password" placeholder="Lösenord"> <br>
    <input type="submit" value="Logga in">
</form>

<?php

Template::footer();