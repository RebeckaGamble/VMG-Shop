<?php
require_once __DIR__ . "/User.php";

session_start();

class Template 
{
    public static function header($title) 
    { 
        $is_logged_in = isset($_SESSION["user"]);

        $logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

        $is_admin = $is_logged_in && $logged_in_user->role == 'admin';

        $cart_count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?> </title>
            <link rel="stylesheet" href="/vmg/assets/style.css">
        </head>

        <body>
        <p class="banner">
                Fri frakt över 499 kr
                Snabb klimatkompenserad leverans
                Säkra betalningar</p>
        <div class="body">
            <div class="header">

                <h1 class="nav-title"><?= $title ?></h1>
            </div>

            <nav class="navbar">
                <a href="/vmg/index.php">Start</a>
                <a href="/vmg/pages/products.php">Products</a>
                <a href="/vmg/pages/cart.php">Cart (<?= $cart_count ?>)</a>

                <?php if (!$is_logged_in) : ?>
                    <a href="/vmg/pages/login.php">Login</a>
                    <a href="/vmg/pages/register.php">Register</a>

                <?php elseif($is_admin): ?>
                    <a href="/vmg/pages/admin.php">Admin page</a>
                <?php endif; ?>

            </nav>

            <?php if ($is_logged_in) : ?> 
                <p>
                    <b>Logged in as: </b>
                    <?= $logged_in_user->username ?>

                    <form action="/vmg/scripts/post-logout.php" method="post">
                        <input type="submit" value="Logout">
                    </form>
                </p>
            <?php endif; ?>
        

        <hr>
    <?php 
   }

   public static function footer() 
    { 
    ?>
       <hr>
        <footer class="footer">
            Copyright VMG 2022
        </footer>

        <script src="/vmg/assets/script.js"></script>
        </div>
    </body>
    </html>
    <?php  }
}