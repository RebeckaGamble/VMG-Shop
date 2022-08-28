<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/User.php";

class UsersDatabase extends Database {

    public function get_one_by_username($username) {
        $query = "SELECT * FROM users WHERE username = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_user = mysqli_fetch_assoc($result);

        $user = null;

        if ($db_user) {
            $user = new User($db_user["username"], $db_user["role"], $db_user["id"]);

            $user->set_password_hash($db_user["password-hash"]);
        }

        return $user;

    }
    
    //get all
    public function get_all() {
        $query = "SELECT * FROM users";

        $result = mysqli_query($this->conn, $query);

        $db_users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $users = [];

        foreach($db_users as $db_user) {
            $user = new User($db_user["username"], 
            $db_user["role"], 
            $db_user["id"]);
            
            $users[] = $user;
        }

        return $users;
    }

    public function  create(User $user) {
        $query = "INSERT INTO users (`username`, `password-hash`, `role`) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("sss", $user->username, $user->get_password_hash(), $user->role);
        
        $success = $stmt->execute();

        return $success;
    }

    //update
    public function update($role, $id){
        $query = "UPDATE users SET `role` = ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("si", $role, $id);

        $success = $stmt->execute();

        return $success;
    }

    //delete
    public function delete($id) {
        $query = "DELETE FROM users WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    //google login
    public function get_google_user_id(User $user)
   {
       $db_user = $this->get_one_by_username($user->username);

       if ($db_user == null) {

           $query = "INSERT INTO users (username, `role`) VALUES (?,?)";

           $stmt = mysqli_prepare($this->conn, $query);

           $stmt->bind_param("ss", $user->username, $user->role);

           $success = $stmt->execute();

           if ($success) {
               $user->id = $stmt->insert_id;
           } else {
            var_dump($stmt->error);
            die("Error saving google user");
           }
       } else {
           $user = $db_user;
       }
       return $user->id;
   }
}
