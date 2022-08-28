<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/User.php";

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

Template::header("Uppdatera användare");

?>

<form action="/vmg/admin-scripts/post-edit-user.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>"> <br>
    <!--syns ej--><label><?= $username ?></label> <br>
    <select name="role" id="role">
        <option value="role" selected disabled>Roll</option>
        <option value="admin">Admin</option>
        <option value="customer">Användare</option>
    </select>
    <br><br>
    <input type="submit" value="Spara">
</form>

<form action="/vmg/admin-scripts/post-delete-user.php" method="post">
    <input type="hidden" name="id" value="<?= $_GET["id"] ?> ">
    <input type="submit" value="Delete user">
</form>
<hr>

<?php

Template::footer();
