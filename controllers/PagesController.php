<?php

    function index () {
        render("pages/index", [
            "title" => "Shoppers Online"
        ]);
    }

    function about () {
        render("pages/about", [
            "title" => "About Us"
        ]);
    }

    function contact () {
        render("pages/contact", [
            "title" => "Contact Us"
        ]);
    }

?>