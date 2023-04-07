<?php

    require_once("./models/ProductModel.php");
    require_once("./models/CartModel.php");

    function index () {
        if(!is_authorized()) return;
        $products = ProductModel::findAll($_SESSION["user"]);

        render("products/index", [
            "products" => $products,
            "title" => "Products"
        ]);
    }

    function _new () {
        if(!is_authorized()) return;
        $carts = CartModel::findAll($_SESSION["user"]);
        render("products/new", [
            "title" => "New Product",
            "action" => "create",
            "carts" => ($carts ?? [])
        ]);
    }

    function edit ($request) {
        if(!is_authorized()) return;
        if (!isset($request["params"]["id"])) {
            return redirect("", ["errors" => "Missing required ID parameter"]);
        }

        $product = ProductModel::find($request["params"]["id"], $_SESSION["user"]);
        if (!$product) {
            return redirect("", ["errors" => "Product does not exist"]);
        }

        $carts = CartModel::findAll($_SESSION["user"]);

        render("products/edit", [
            "title" => "Edit Product",
            "product" => $product,
            "edit_mode" => true,
            "action" => "update",
            "carts" => ($carts ?? [])
        ]);
    }

    function create () {
        if(!is_authorized()) return;
        // Validate field requirements
        validate($_POST, "products/new");
        
        // Write to database if good
        ProductModel::create($_POST, $_SESSION["user"], $_SESSION["user"]);

        // try to add products to redirect ***************************
        redirect("products", ["success" => "Product was created successfully"]);
    }

    function update () {
        if(!is_authorized()) return;
        // Missing ID
        if (!isset($_POST['id'])) {
            return redirect("products", ["errors" => "Missing required ID parameter"]);
        }

        // Validate field requirements
        validate($_POST, "products/edit/{$_POST['id']}");

        // Write to database if good
        ProductModel::update($_POST, $_SESSION["user"]);
        redirect("products", ["success" => "Product was updated successfully"]);
    }

    function delete ($request) {
        if(!is_authorized()) return;
        // Missing ID
        if (!isset($request["params"]["id"])) {
            return redirect("products", ["errors" => "Missing required ID parameter"]);
        }

        ProductModel::delete($request["params"]["id"], $_SESSION["user"]);

        // error occurs here!!!
        // redirect("products", ["success" => "Product was deleted successfully"]);
        redirect("", ["success" => "Product was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["product_name", "cart_id"];
        $errors = [];

        // No empty fields
        foreach ($fields as $field) {
            if (empty($package[$field])) {
                $humanize = ucwords(str_replace("_", " ", $field));
                $errors[] = "{$humanize} cannot be empty";
            }
        }

        if (count($errors)) {
            return redirect($error_redirect_path, ["form_fields" => $package, "errors" => $errors]);
        }
    }

    function is_authorized(){
        if(session_status() === PHP_SESSION_NONE) session_start();
        if(!isset($_SESSION["user"])){
            return redirect("login", ["errors" => "You must be logged in to access this"]);
        }
        return true;
    }
?>