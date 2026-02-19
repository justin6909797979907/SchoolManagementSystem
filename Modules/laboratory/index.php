<?php

require_once __DIR__ . '/config/config.php';

session_start();

$basePath = BASE_URL;
$uri = trim(str_replace($basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');




switch ($uri) {

    case '':
        require_once __DIR__ . '/app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
        
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}






