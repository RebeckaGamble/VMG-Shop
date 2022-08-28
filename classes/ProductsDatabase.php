<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Product.php";

class ProductsDatabase extends Database {

    public function get_one($id) {
        $query = "SELECT * FROM products WHERE id = ?";
        
        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_product = mysqli_fetch_assoc($result);

        $products = null;

        if ($db_product) {

            $products = new Product ( 
                $db_product["title"], 
                $db_product["description"], 
                $db_product["price"], 
                $db_product["img_url"], 
                $id );

        }

        return $products;
    }


    public function get_all(){
        $query = "SELECT * FROM products";

        $result = mysqli_query($this->conn, $query);

        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $products= [];

        foreach($db_products as $db_product){
            $db_id = $db_product["id"];
            $db_title = $db_product["title"];
            $db_description = $db_product["description"];
            $db_price = $db_product["price"];
            $db_img_url = $db_product["img_url"];


            $products[] = new Product($db_title, $db_description, $db_price, $db_img_url, $db_id);
        }

        return $products;
    }

    // Get by order_ID from `order_` / Tar emot orderID & produktID och lägger till det i tabellen order-products
    public function get_by_order_id($order_id)
    {
        $query = "SELECT op.id, op.`order_id`, u.username, p.`title`, p.`description`, p.price,  p.`img_url`, o.`user_id`, o.`order_date`, o.`status` FROM `order-products` AS op
        JOIN orders AS o ON op.`order_id` = o.id 
        JOIN users AS u ON o.`user_id` = u.id
        JOIN products AS p ON op.`product_id` = p.id
        WHERE o.`user_id` = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $products = [];

        foreach ($db_products as $db_product) {

            $product = new Product(
                $db_product["title"],
                $db_product["description"],
                $db_product["price"],
                $db_product["img_url"],

            );

            $products[] = $product;
        }

        return $products;
    }
    
    public function create(Product $product){
        $query = "INSERT INTO products (`title`, `description`, `price`, `img_url`) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("ssis", $product->title, $product->description, $product->price, $product->img_url);

        $success = $stmt->execute();

        return $success;
    }

    public function update_product(Product $product, $id){
        $query = "UPDATE products SET `title`=?, `description`=?, `price`=?, `img_url`=? WHERE id=?";
        
        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("ssssi", $product->title, $product->description, $product->price, $product->img_url, $id);

        return $stmt->execute();

    }

    //delete
    public function delete($id) {
        $query = "DELETE FROM products WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}