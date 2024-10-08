<?php
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

require_once "./app/controllers/controllerTurns.php";
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
    $controller=new controller();
    $controller-> showHome();
    break;
    
    case 'faq':
    $controller=new controller();
    $controller-> showFAQ();
    break;

    case 'turnos';
    $controller=new controller();
    $controller->getTurns();
    $controller->getCategories();
    break;

    case 'detalle';
    $controller=new controller();
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
    $controller = new controller();
    $controller->createTurns(); //borrramos los parametro (($id, $fecha, $hora, $consultorio, $medico, $id_paciente)
    break;

    case 'deleteTurns':
    $controller = new controller();
    $controller->deleteTurns($params[1]);
    break;

    case 'updateTurns':
    $controller = new controller();
    $controller->updateTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
    break;
}
?>