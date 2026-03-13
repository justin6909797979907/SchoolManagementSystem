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
    
    case 'damages':
        require_once __DIR__ . '/app/controllers/DamageController.php';
        $controller = new DamageController();
        $controller->index();
        break;

    case 'damages/create':
        require_once __DIR__ . '/app/controllers/DamageController.php';
        $controller = new DamageController();
        $controller->create();
        break;

      case 'damages/view/:id':
        // require_once __DIR__ . '/app/controllers/DamageController.php';
        // $controller = new DamageController();
        // $controller->view($_GET['id']);

        echo "hi";

        break;
        
    case 'burrow':

        require_once __DIR__ . '/app/controllers/BurrowController.php';
        $controller = new BurrowController();
        $controller->index();
        break;

    case 'inventory':

        require_once __DIR__ . '/app/controllers/InventoryController.php';
        $controller = new InventoryController();
        $controller->index();
        break;

    case 'settings':
        require_once __DIR__ . '/app/controllers/SettingsController.php';
        $controller = new SettingsController();
        $controller->index();
        break;


    default:
        http_response_code(404);
        require_once __DIR__ . '/app/views/errors/404.php';
        break;
}