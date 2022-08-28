<?php

require_once __DIR__ . "/../classes/Template.php";

Template::header("VMG SHOP");

if(isset($_GET["error"]) && $_GET["error"] == "wrong_pass"): ?> 
    <h2>Fel användarnamn eller lösenord!</h2>
<?php endif; ?>

<h2 class="page-title">Logga in</h2>

<form action="/vmg/scripts/post-login.php" method="post" class="form-user">
    <input type="text" name="username" placeholder="Användarnamn"> <br>
    <input type="password" name="password" placeholder="Lösenord"> <br>
    <input type="submit" value="Logga in" class="btn-form">
    <div class="google-btn">
            <?php
            echo '<div align="center">' . $google_login_btn . '</div>';
            ?>
        </div>
</form>



<?php

Template::footer();