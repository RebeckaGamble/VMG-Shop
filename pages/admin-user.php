<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";



$username = $_GET["username"];
$id = $_GET["id"];


$db = new UsersDatabase();

$user = $db->get_one_by_username($username);

Template::header("Edit user");

?>

<form action="/vmg/admin-scripts/post-edit-user.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>"> <br>
    <!--syns ej--><label><?= $username ?></label> <br>
    <select name="role" id="role">
        <option value="role" selected disabled>Role</option>
        <option value="admin">Admin</option>
        <option value="customer">Customer</option>
    </select>
    <br><br>
    <input type="submit" value="Save">
</form>

<hr>

<?php

Template::footer();