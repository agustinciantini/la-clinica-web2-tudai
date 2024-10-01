<?php
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

require_once "./app/controllers/controllerTurns.php";
require_once './app/controllers/auth.controller.php';
require_once './libs/response.php';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home'; // acción por defecto si no envían nada.
}
$res = new Response();

$params = explode('/', $action);

switch ($params[0]) {
    case 'home';
    $controller=new controller();
    $controller-> showHome();
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

    case 'sacarTurno':
        showSacarTurno();
        break;
        /*
    case 'tarifas':
        showTarifas();
        break;
    case 'preguntasFrecuentes':
        showFAQ();
        break;
    case 'prevencion':
        showPrevencion();
        break;
    case 'index':
        showIndex();
        break;*/
    }
?>