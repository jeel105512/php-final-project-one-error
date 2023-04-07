<?php

    class ProductModel {

        private static $_table = "products";

        public static function findAll ($user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT products.id, product_name, price, description, carts.cart_name AS cart
                    FROM {$table}
                    JOIN carts ON products.cart_id = carts.id
                    WHERE products.user_id = {$user['id']} AND carts.user_id = {$user['id']}";

            $products = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $products;
        }

        public static function find ($id, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT products.id, product_name, price, description, cart_id, carts.cart_name AS cart
                    FROM {$table}
                    JOIN carts ON products.cart_id = carts.id
                    WHERE products.id = :id AND products.user_id = {$user['id']} AND carts.user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $product = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $product;
        }

        public static function create ($package, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                product_name,
                price,
                description,
                cart_id,
                user_id
            ) VALUES (
                :product_name,
                :price,
                :description,
                :cart_id,
                :user_id
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":product_name", $package["product_name"], PDO::PARAM_STR);
            $stmt->bindParam(":price", $package["price"], PDO::PARAM_STR); 
            $stmt->bindParam(":description", $package["description"], PDO::PARAM_STR); 
            $stmt->bindParam(":cart_id", $package["cart_id"], PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user["id"], PDO::PARAM_INT);
            var_dump($stmt);
            $stmt->execute();
            $conn = null;
        }

        public static function update ($package, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                product_name = :product_name,
                price = :price,
                description = :description,
                cart_id = :cart_id
            WHERE id = :id AND user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":product_name", $package['product_name'], PDO::PARAM_STR);
            $stmt->bindParam(":price", $package['price'], PDO::PARAM_STR);
            $stmt->bindParam(":description", $package['description'], PDO::PARAM_STR);
            $stmt->bindParam(":cart_id", $package['cart_id'], PDO::PARAM_INT);
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