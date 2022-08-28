<!-- Ej färdigt  -->

<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Order.php";

class Ordersdatabase extends Order
{

    public function get_all_orders()
    {
        $query = "SELECT * FROM orders";

        $result = mysqli_query($this->conn, $query);

        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $orders = [];

        foreach ($db_orders as $db_order) {
            $db_id = $db_order["id"];
            $db_customer_id = $db_order["customer_id"];
            $db_status = $db_order["status"];
            $db_date = $db_order["date"];

            $orders[] = new Order($db_customer_id, $db_status, $db_date, $db_id);
        }
        return $orders;
    }
    public function get_one_order($id)
    {
        $query = "SELECT * FROM orders WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_orders = mysqli_fetch_assoc($result);

        $orders = null;

        if ($db_orders) {

            $orders = new Order($db_orders["customer_id"], $db_orders["status"], $db_orders["date"], $id);
        }

        return $orders;
    }

}
