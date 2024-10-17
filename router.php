<?php
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

require_once "./app/controllers/controllerTurns.php";
require_once "./app/controllers/controllerCategory.php";
require_once './app/controllers/auth.controller.php';
require_once './libs/response.php';
require_once './app/middlewares/session.auth.middleware.php';
require_once './app/models/modelDeploy.php';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home'; // acción por defecto si no envían nada.
}
$res = new Response();

$params = explode('/', $action);

switch ($params[0]) {
    case 'home';
        $deploy = new modelDeploy();
        $controller = new controllerTurns();
        $controller->showHome();
        break;
    
    case 'faq':
        $controller = new controllerTurns();
        $controller->showFAQ();
        break;

    case 'turnos'; //Mostrar ítems(turnos) y categorías(pacientes).
        $controller = new controllerTurns();
        $controllerCategory = new controllerCategory();
        $controller->getTurns();
        $controllerCategory->getCategories();
        break;

    case 'detalle'; //Ver detalle de un ítem(turno).
        $controller = new controllerTurns();
        $controller->getTurnById($params[1]);
        break;

    case 'ver';  //Ver detalle de una categoría(paciente).
        $controller = new controllerTurns();
        $controller->getTurnsByIdCategory($params[1]);
        break;    

    case 'login';
        $controller = new AuthController();
        $controller->login();
        break;

    case 'showLogin';
        $controller = new AuthController();
        $controller->showLogin();
        break;

    case 'logout';
        $controller = new AuthController();
        $controller->logout();
        break;
    
    case 'createTurns':
        sessionAuthMiddleware($res); //Consultar
        $controller = new controllerTurns();
        $controller->createTurns();
        break;
        
    case 'deleteTurns':
        sessionAuthMiddleware($res); //Consultar
        $controller = new controllerTurns();
        $controller->deleteTurns($params[1]);
        break;
        
    case 'updateTurns':
        sessionAuthMiddleware($res); //Consultar
        $controller = new controllerTurns();
        $controller->updateTurns($params[1]);
        break;

    case 'createCategories':
        sessionAuthMiddleware($res); //Consultar
        $controller = new controllerCategory();
        $controller->createCategories(); 
        break;

    case 'deleteCategories':
        sessionAuthMiddleware($res); //Consultar
        $controller = new controllerCategory();
        $controller->deleteCategories($params[1]);
        break;

    case 'updateCategories':
        sessionAuthMiddleware($res); //Consultar
        $controller = new controllerCategory();
        $controller->updateCategories($params[1]);
        break;
}