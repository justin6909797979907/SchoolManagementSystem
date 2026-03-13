<?php

require_once __DIR__ . '/config/config.php';

session_start();

$basePath = BASE_URL;
$uri = trim(str_replace($basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');

$segments = explode('/', $uri); 

switch ($segments[0] ?? '') {

    case '':
        require_once __DIR__ . '/app/controllers/HomeController.php';
        (new HomeController())->index();
        break;

    case 'damages':

        require_once __DIR__ . '/app/controllers/DamageController.php';
        $controller = new DamageController();

        if (!isset($segments[1])) {
            $controller->index();
        }

        elseif ($segments[1] === 'create') {
            $controller->create();
        }

        elseif ($segments[1] === 'view' && isset($segments[2])) {
            $controller->view($segments[2]);
        }

         elseif ($segments[1] === 'edit' && isset($segments[2])) {
            $controller->edit($segments[2]);
        }

         elseif ($segments[1] === 'delete' && isset($segments[2])) {
            $controller->destroy($segments[2]);
        }

         elseif ($segments[1] === 'update') {
            $controller->update();
        }

        break;

    case 'inventory':
        require_once __DIR__ . '/app/controllers/InventoryController.php';
        (new InventoryController())->index();
        break;

    default:
        http_response_code(404);
        require_once __DIR__ . '/app/views/errors/404.php';
}