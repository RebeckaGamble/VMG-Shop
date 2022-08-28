<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
$total_sum = array_sum(array_column($products, 'price'));
$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;


Template::header("Varukorg");


?>

<h2 class="page-title">Varukorg</h2>

<div id="product-details" hidden>
    <img src="" id="product-img" height="70" width="70">
    <p id="product-name"></p>
    <p id="product-description"></p>
    <p id="product-price"></p>
</div>

<?php if (!$products) : ?>
    <h2>Varukorgen är tom</h2>
    <a href="/vmg/index.php">Gå tillbaka till startsidan</a>

<?php elseif ($_SESSION["cart"] && $products) : ?>

    <div class="products-grid-cart">
    <?php foreach ($_SESSION["cart"] as $cart_product) : ?>
        <article class="product-cart">
            <img src="<?= $cart_product->img_url ?>" class="product-image-cart" alt="Product image">
            <div>
                <b><?= $cart_product->title ?></b>
                <i><?= $cart_product->price ?> kr</i>


            </div>

            </form>
            </article>
        <?php endforeach ?>
        </div>

        <?php if (count($products) > 0) : ?>
            <h3> Total:
                <?= $total_sum ?> kr
            </h3>
            <form action="/vmg/scripts/delete-from-cart.php" method="POST">
                <input type="hidden" name="product-id" value="<?= $cart_product->id ?>">
                <input type="submit" value="Töm kundkorg" class="btn-red">
            </form>
        <?php endif ?>
        

        <?php if (!$is_logged_in) : ?>
            <button><a href="/vmg/pages/register.php">Skapa konto</a></button>
            eller
            <button><a href="/vmg/pages/login.php">Logga in för avsluta köpet</a></button>

        <?php elseif ($is_logged_in) : ?>
            <form action="/vmg/scripts/post-place-order.php" method="post">
                <input type="submit" value="Place order" class="btn">
            </form>

        <?php endif ?>
    <?php endif ?>

    <?php
    Template::footer();
