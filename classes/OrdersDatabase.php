<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Order.php";


class OrdersDatabase extends Database
{

    // Ska hämta alla ordrar från alla användare, när man är inloggad som admin. FÄRDIG!! 
    public function get_all_orders()
    {
        $query = "SELECT * FROM orders";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $orders = [];

        foreach ($db_orders as $db_order) {
            $orders[] = new Order (
                $db_order["user_id"], 
                $db_order["status"], 
                $db_order["order_date"], 
                $db_order["id"]
            );
        }
        return $orders;
    }

    // Hämtar en order, med specifik order nummer från tabellen orders. Används från admin sidan. FÄRDIG!! 
    public function get_order_by_order_id($id)
    {
        $query = "SELECT * FROM orders WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_order = mysqli_fetch_assoc($result);

        $order = null;

        if ($db_order) {
            $db_id = $db_order["id"];
            $db_user_id = $db_order["user_id"];
            $db_status = $db_order["status"];
            $db_order_date = $db_order["order_date"];

            $order = new Order($db_user_id, $db_status, $db_order_date, $db_id);
        }
        return $order;
    }

    // Hämtar alla ordrar som man beställt som användare, poppar upp på pages/orders FÄRDIG!! 
    public function get_order_by_user_id($user_id)
    {
        $query = "SELECT * FROM `orders` where `user_id` = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $orders;
    }


    // Skapar order och lägger in i tabellen `orders` FÄRDIG!! 
    public function create_order_to_orders(Order $order)
    {
         $query = "INSERT INTO `orders` (`user_id`, `status`, `order_date`) VALUES (?, ?, ?)";

         $stmt = mysqli_prepare($this->conn, $query);

         $stmt->bind_param("iss", $order->user_id, $order->status, $order->order_date);

         $success = $stmt->execute();

        if($success) {
            return $stmt->insert_id;
        }
        return false;
    }

    // Skapar `order-products` så att tabellen från ´products`+ `orders`sätts ihop FÄRDIG!
    public function create_order_to_order_products($order_id, $product_id)
    {
        $query = "INSERT INTO `order-products` (`order_id`, `product_id`) VALUES (?,?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("ii", $order_id, $product_id);

        $success = $stmt->execute();

        return $success;
    }

    // Get by order_ID from `order_` / Tar emot orderID & produktID och lägger till det i tabellen order-products
    public function get_products_by_order_id($order_id)
    {
        $query =
        "SELECT * FROM `order-products` 
        JOIN orders ON orders.id = `order-products`.`order_id` 
        JOIN products ON products.id = `order-products`.`product_id` 
        WHERE order_id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $order_id);

        $stmt->execute();
        
        $result = $stmt->get_result();

        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $products;
    }

    // Updatera status
    public function update_status($order_id, $status) {
        $query = "UPDATE orders SET `status` = ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("si", $status, $order_id);

        $success = $stmt->execute();

        return $success;
    }
}
