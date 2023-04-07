<?php
    // Require our route definitions
    require_once("routes.php");

    // Load render function
    require_once("render.php");

    // Load connect function
    require_once("connect.php");

    // Create a connection helper
    function get_connection () {
        return connect("localhost", "comp_1006_200528741", "root", "", 3308);
    };

    // Provide a root path helper
    $root_path = dirname($_SERVER['PHP_SELF']);
    define("ROOT_PATH", $root_path);

    // Normalize the paths
    $php_self = strtolower(rawurldecode(dirname($_SERVER['PHP_SELF'])));
    $request_uri = strtolower(rawurldecode($_SERVER['REQUEST_URI']));

    // Remove the app path route and return only the requested path
    $requested_path = str_replace($php_self, "", $request_uri);

    // Separate the requested path and any query parameters
    $parsed_uri = parse_url($requested_path);
    $queries = [];
    if (isset($parsed_uri["query"])) parse_str($parsed_uri["query"], $queries);

    $http_verb = strtolower($_SERVER["REQUEST_METHOD"]);

    // Provide some debugging information
    $routes_list = json_encode($routes[$http_verb]);
    echo "<script>
        console.log({
            phpSelf: '{$php_self}',
            requestURI: '{$request_uri}',
            requestedPath: '{$requested_path}',
            parsedURI: '{$parsed_uri["path"]}',
            httpVerb: '{$http_verb}',
            availableRoutes: JSON.parse('{$routes_list}')
        });
    </script>";

    foreach ($routes[$http_verb] as $route) {
        // Get the regex pattern
        $regex_pattern = convert_pattern_to_regex($route["pattern"]);

        // Attempt to match our requested path with the regex pattern
        // Store any params found
        if (preg_match($regex_pattern, $parsed_uri["path"], $params)) {
            // Load the attached controller
            require_once("./controllers/{$route['controller']}.php");
            
            // Build the request object
            $request = [
                "params" => ($params ?? []),
                "queries" => $queries
            ];

            // Call the controller action
            return call_user_func($route["action"], $request);
        }
    }

    // Return a 404
    return render("pages/404", ["title" => "Not Found"]);

    // Parse our human readable pattern into proper regex
    function convert_pattern_to_regex ($pattern) {
        // escape slashes
        $pattern = str_replace("/", "\/", $pattern);

        // Replace our parameter placeholder with real regex capture groups
        $pattern = preg_replace("/:(\w+)/", "(?P<$1>\w+)", $pattern);

        // Return the formatted regex pattern
        return "/^{$pattern}$/";
    }

?>