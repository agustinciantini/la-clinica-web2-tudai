<?php
require_once './app/models/modelTurns.php';
require_once './app/views/viewTurns.php';
class controllerTurns{
    private $view;
    private $model;

    public function __construct(){
        $this->view = new ViewTurns();
        $this->model = new ModelTurns();
    }
    public function showHome(){  //Muestra el home.
        $this->view->showHome();
    }
    public function showFaq(){  //Muestra faq.
        $this->view->showFaq();
    }
    public function getTurns(){  //Muestra turnos.
        $turns = $this->model->getTurns();
        $this->view->showTurns($turns);
    }
    public function getTurnById($id){ //Muestra un turno especifico (id).
        $turnos = $this->model->getTurnById($id);
        if(!$turnos){
            echo("no existe");
        }
        $this->view->showTurnById($turnos);
    }
    public function createTurns(){
        if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
            return $this->view->showHome(); // crear msj de error
        }
        if (!isset($_POST['hora']) || empty($_POST['hora'])) {
            return $this->view->showHome();
        }

        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $consultorio = $_POST['consultorio'];
        $medico = $_POST['medico'];
        $id_paciente = intval($_POST['id_paciente']);

        $turn = $this->model->createTurns($fecha, $hora, $consultorio, $medico, $id_paciente);
        $this->view->showTurnById($turn);
        
        header('Location:'. BASE_URL . 'turnos');
    }
    public function deleteTurns($id) {
        $turn = $this->model->getTurnById($id);
        
        if (!$turn) {
            return $this->view->showHome();
        }
        $this->model->deleteTurns($id);
        header('Location:'. BASE_URL . 'turnos');
    }

    public function updateTurns($id){
        $turn = $this->model->getTurnById($id);

        if (!$turn) {
            echo("El turno no exixte"); 
        }
        if (!isset($_POST['fecha']) || empty($_POST['fecha']) || 
        !isset($_POST['hora']) || empty($_POST['hora']) || 
        !isset($_POST['consultorio']) || empty($_POST['consultorio']) || 
        !isset($_POST['medico']) || empty($_POST['medico'])) {
            // archivo de error 
            echo ("Por favor, complete todos los campos obligatorios.");
        } 

        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $consultorio = intval($_POST['consultorio']);
        $medico = $_POST['medico'];

        $this->model->updateTurns($id, $fecha, $hora, $consultorio, $medico);
        header('Location:'. BASE_URL . 'turnos');

        if (!$turn) {
            return $this->view->showHome();
        }
    }
}