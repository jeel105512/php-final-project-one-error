<?php

    class UserModel {

        private static $_table = "users";

        public static function find ($email) {
            $table = self::$_table;
            $conn = get_connection();

            $sql = "SELECT * FROM {$table} WHERE email = :email";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;

            return $user;
        }

        public static function create ($package) {
            $table = self::$_table;
            $conn = get_connection();

            $sql = "INSERT INTO {$table} (
                name,
                email,
                password
            ) VALUES (
                :name,
                :email,
                :password
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $package["name"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $package["email"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $package["password"], PDO::PARAM_STR);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
        }

    }

?>