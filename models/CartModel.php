<?php

    class CartModel {

        private static $_table = "carts";

        public static function findAll ($user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table} WHERE user_id = {$user['id']}";

            $carts = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $carts;
        }

        public static function find ($id, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table} WHERE id = :id AND user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $cart = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $cart;
        }

        public static function create ($package, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                cart_name,
                user_id
            ) VALUES (
                :cart_name,
                :user_id
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":cart_name", $package["cart_name"], PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $user["id"], PDO::PARAM_INT);
            // var_dump($stmt);
            // var_dump($user);

            $stmt->execute();
            $conn = null;
        }

        public static function update ($package, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                cart_name = :cart_name
            WHERE id = :id AND user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":cart_name", $package['cart_name'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $package['id'], PDO::PARAM_INT);
            
            $stmt->execute();
            $conn = null;
        }

        public static function delete ($id, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "DELETE FROM {$table} WHERE id = :id AND user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

    }

?>