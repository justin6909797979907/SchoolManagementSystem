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
       $controller = new InventoryController();

        if (!isset($segments[1])) {
            $controller->index();
        }
        elseif ($segments[1] === 'create'){
            $controller->create();
        }
         elseif ($segments[1] === 'view' && isset($segments[2])){
            $controller->view($segments[2]);
        }
          elseif ($segments[1] === 'delete' && isset($segments[2])){
            $controller->destroy($segments[2]);
        }

         elseif ($segments[1] === 'update'){
            $controller->update();
        }

        break;

    case 'psycho-inventory':
        require_once __DIR__ . '/app/controllers/PsychoInvController.php';
        $controller = new PsychoInvController();

        if (!isset($segments[1])) {
            $controller->index();
        }
        elseif ($segments[1] === 'create'){
            $controller->create();
        }
         elseif ($segments[1] === 'view' && isset($segments[2])){
            $controller->view($segments[2]);
        }
          elseif ($segments[1] === 'delete' && isset($segments[2])){
            $controller->destroy($segments[2]);
        }

         elseif ($segments[1] === 'update'){
            $controller->update();
        }

        break;

   case 'he-inventory':
        require_once __DIR__ . '/app/controllers/HeInvController.php';
        $controller = new HeInvController();

        if (!isset($segments[1])) {
            $controller->index();
        }

        elseif ($segments[1] === 'create') {
            $controller->create();
        }
        
        elseif ($segments[1] === 'view' && isset($segments[2])){
            $controller->view($segments[2]);
        }

         elseif ($segments[1] === 'delete' && isset($segments[2])){
            $controller->destroy($segments[2]);
        }

         elseif ($segments[1] === 'update'){
            $controller->update();
        }
        

    case 'crim-inventory':
        require_once __DIR__ . '/app/controllers/CrimInvController.php';
        $controller = new CrimInvController();

        if (!isset($segments[1])) {
            $controller->index();
        }

        elseif ($segments[1] === 'create') {
            $controller->create();
        }
        
        elseif ($segments[1] === 'view' && isset($segments[2])){
            $controller->view($segments[2]);
        }

         elseif ($segments[1] === 'delete' && isset($segments[2])){
            $controller->destroy($segments[2]);
        }

         elseif ($segments[1] === 'update'){
            $controller->update();
        }
        break;

    case 'crim-borrow':
        require_once __DIR__ . '/app/controllers/CrimBrwController.php';
        (new CrimBrwController())->index();
        break;

     case 'crim-damage':
        require_once __DIR__ . '/app/controllers/CrimDmgController.php';
        (new CrimDmgController())->index();
        break;    
        
        break;
    case 'psycho-damage':
        require_once __DIR__ . '/app/controllers/PsychoDmgController.php';
        (new PsychoDmgController())->index();
        break;
        
    default:
        http_response_code(404);
        require_once __DIR__ . '/app/views/errors/404.php';
}