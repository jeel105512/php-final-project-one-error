<?php

    function render ($view, $locals = [], $layout = "main") {
        // Set default views path
        set_include_path("./views");

        // Makes variables available to the view
        extract($locals);

        // Extract any redirected locals
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION["locals"])) {
            extract($_SESSION["locals"]);
            unset($_SESSION["locals"]);
        }

        // Start the buffer
        ob_start();

        // Any output is saved into the buffer
        include("{$view}.php");

        // This stores the output into a variable
        $yield = ob_get_contents();

        // This clears the buffer
        ob_end_clean();

        try {
            require_once("layouts/{$layout}.php");
        } catch (Error $e) {
            echo $e->getMessage();
            echo $yield;
        }
    }

    function redirect ($location, $locals) {
        if (session_start() === PHP_SESSION_NONE) session_start();
        $_SESSION["locals"] = $locals;
        header("Location: " . ROOT_PATH . "/{$location}");
        die();
    }

?>