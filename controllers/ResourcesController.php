<?php

    require_once("./models/ResourceModel.php");

    function index () {
        render("resources/index", [
            "title" => "Index"
        ]);
    }

    function show () {
        render("resources/show", [
            "title" => "Show"
        ]);
    }

    function _new () {
        render("resources/new", [
            "title" => "New",
            "action" => "create"
        ]);
    }

    function edit ($request) {
        render("resources/edit", [
            "title" => "Edit",
            "action" => "update"
        ]);
    }

    function create () {}

    function update () {}

    function delete ($request) {}

    function validate ($package, $error_redirect_path) {}

    function sanitize($package) {}

?>