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
            <script src="https://kit.fontawesome.com/392acbfbb6.js" crossorigin="anonymous"></script>
        </head>

        <body>
            <div class="header">
                <img src="/vmg/assets/back.jpeg" alt="vase" class="background-image" />
                <h1 class="nav-title"><?= $title ?></h1>
            </div>

            <nav class="navbar">
                <a href="/vmg/index.php">Start</a>
                <a href="/vmg/pages/products.php">Products</a>
                <a href="/vmg/pages/cart.php"><i class="fa-solid fa-cart-shopping"></i>Cart (<?= $cart_count ?>)</a>

                <?php if (!$is_logged_in) : ?>
                    <a href="/vmg/pages/login.php">Login</a>
                    <a href="/vmg/pages/register.php">Register</a>

                <?php elseif ($is_admin) : ?>
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
        <footer class="footer">
            <div class="footer-container">
                <div class="about">
                    <div class="vmg">
                        <h3>OM OSS</h3>
                        <p> 
                            Vi har sedan starten 2003 haft ett nära samarbete med några av de 
                            mest välkända märkena, liksom nya talanger inom branschen. <br> <br>
                            Vaser är både konstverk och inredningsdetaljen som kan få ett helt
                            rum att blomma upp. <br>
                            Därför har vi genom ett noga urval av vaser i 
                            olika designer sett till att varje hem kan få en unik look. <br> 
                        </p>
                        <a href="">Jobba hos oss</a>
                    </div>

                    <div class="contact">
                        <h3>KONTAKTA OSS</h3>
                        <p><a href="">08 442 34 22</a></p> 
                        <a href="">info@vmg.se</a>
                    </div>

                    <div class="info">
                        <h3>INFORMATION</h3>
                        <p><a href="">Köpvillkor</a></p>
                        <p><a href="">Frakt/Leverans</a></p>
                        <p><a href="">Betalning</a></p>
                        <p><a href="">Retur/Reklamation</a></p>
                        <p><a href="">Presentkort</a></p>
                    </div>

                    <div class="contact">
                        <h3>FÖLJ OSS</h3>
                        <p> <i class="fa-brands fa-facebook fa-xl"></i></p>
                        <p><i class="fa-brands fa-instagram fa-xl"></i></p>
                    </div>

                    <div class="pay-with">
                        <h3>HANDLA TRYGGT</h3>
                       <p> <i class="fa-brands fa-cc-mastercard fa-xl"></i></p>
                       <p> <i class="fa-brands fa-cc-visa fa-xl"></i></p>
                    </div>
                </div>

                <div class="bottom">
                    <h2 class="bottom-title">VMG.se</h2>
                    <p>Copyright 2022 VMG.se </p> 
                    <p>Org.nr 556030-3189</p>
                </div>
            </div>
        </footer>

        <script src="/vmg/assets/script.js"></script>

    </body>
    </html>
    <?php  }
}
