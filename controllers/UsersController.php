<?php

    require_once("./models/UserModel.php");

    function _new () {
        render("users/new", ["title" => "Register User"]);
    }

    function login () {
        render("users/login", [
            "title" => "Login"
        ]);
    }

    function create () {
        validate($_POST, "users/new");

        $_POST = sanitize($_POST);

        UserModel::create($_POST);

        redirect("login", ["success" => "User was created successfully"]);
    }

    function authenticate () {
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            redirect("login", ["errors" => "You must provide a valid email and password"]);
        }

        $user = UserModel::find($_POST["email"]);

        if (!$user) {
            redirect("login", ["errors" => "You must provide a valid email and password"]);
        }

        if (password_verify($_POST["password"], $user->password)) {
            if (session_status() === PHP_SESSION_NONE) session_start();

            unset($user->password);
            $_SESSION["user"] = (array) $user;

            redirect("", ["success" => "You have logged in successfully"]);
        }
        // 
        redirect("login", ["errors" => "You must provide an email and password"]);
    }

    function logout () {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            unset($_SESSION["user"]);
            redirect("", ["success" => "You have logged out successfully"]);
        }
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["name", "email", "email_confirmation", "password", "password_confirmation"];
        $errors = [];

        // Check the required fields are not empty
        foreach ($fields as $field) {
            if (empty($package[$field])) {
                $humanize = ucwords($field);
                $errors[]= "{$humanize} cannot be empty";
            }
        }

        // Check the value and value confirmation fields match
        if ($package["email"] !== $package["email_confirmation"]) {
            $errors[]= "Your email must match the email confirmation value";
        }

        if ($package["password"] !== $package["password_confirmation"]) {
            $errors[]= "Your password must match the password confirmation value";
        }

        // Check the email is in the valid format
        if (!filter_var($package["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[]= "Your email must be in a valid format";
        }

        // redirect if there are errors
        if (count($errors) > 0) {
            unset($package["password"]);
            unset($package["password_confirmation"]);

            redirect($error_redirect_path, [
                "form_fields" => $package,
                "errors" => $errors
            ]);
        }
    }

    function sanitize ($package) {
        // Sanitize the data
        // Sanitize the email
        $package["email"] = filter_var($package["email"], FILTER_SANITIZE_EMAIL);

        // Sanitize the name
        $package["name"] = htmlspecialchars($package["name"]);

        // Hash the password
        $package["password"] = password_hash($package["password"], PASSWORD_DEFAULT);

        return $package;
    }

?>