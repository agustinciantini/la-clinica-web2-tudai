<?php
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

require_once "./app/controllers/controllerTurns.php";
require_once "./app/controllers/controllerCategory.php";
require_once './app/controllers/auth.controller.php';
require_once './libs/response.php';
require_once './app/middlewares/session.auth.middleware.php';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home'; // acción por defecto si no envían nada.
}
$res = new Response();

$params = explode('/', $action);

switch ($params[0]) {
    case 'home';
    sessionAuthMiddleware($res); 
    $controller=new controllerTurns();
    $controller-> showHome();
    break;
    
    case 'faq':
    $controller=new controllerTurns();
    $controller-> showFAQ();
    break;

    case 'turnos';
    $controller=new controllerTurns();
    $controllerCategory=new controllerCategory();
    $controller->getTurns();
    $controllerCategory->getCategories();
    break;

    case 'detalle';
    $controller=new controllerTurns();
    $controller->getTurnById($params[1]);
    break;

    case 'login';
    $controller = new AuthController();
    $controller->login();
    break;

    case 'showLogin';
    $controller = new AuthController();
    $controller->showLogin();
    break;
    
    case 'createTurns':
    $controller = new controllerTurns();
    $controller->createTurns(); //borrramos los parametro (($id, $fecha, $hora, $consultorio, $medico, $id_paciente)
    break;

    case 'deleteTurns':
    $controller = new controllerTurns();
    $controller->deleteTurns($params[1]);
    break;

    case 'updateTurns':
    $controller = new controllerTurns();
    $controller->updateTurns($params[1]);
    break;

    case 'deleteCategories':
        $controller = new controllerCategory();
        $controller->deleteCategories($params[1]);
        break;

    case 'createCategories':
        $controller = new controllerCategory();
        $controller->createCategories(); 
        break;
        
    case 'updateCategories':
        $controller = new controllerCategory();
        var_dump($params[1]);
        $controller->updateCategories($params[1]);
        break;
}
