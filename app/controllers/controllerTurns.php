<?php
require_once './app/models/modelTurns.php';
require_once './app/views/viewTurns.php';
class controller{
    private $view;
    private $model;

    public function __construct(){
        $this->view = new ViewTurns();
        $this->model = new ModelTurns();
    }
    public function showHome(){
        $this->view->showHome();
    }

    public function showFAQ(){
        $this->view->showFAQ();
    }
    public function getTurns(){
        $turns = $this->model->getTurns();
        $this->view->showTurns($turns);
    }
    public function getTurnById($id){
        $turn = $this->model->getTurnById($id);
        $this->view->showTurnById($turn);
    }
    public function getCategories(){
        $categories = $this->model->getCategories();
        $this->view->showCategories($categories);
    }
    public function createTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente){
        if (!isset($_POST['turn']) || empty($_POST['turn'])) {
            return $this->view->showHome();
        }
        if (!isset($_POST['¿QUÉ PONGO ACÁ?']) || empty($_POST['¿QUÉ PONGO ACÁ?'])) {
            return $this->view->showHome();
        }

        $id = $_POST['id'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $consultorio = $_POST['consultorio'];
        $medico = $_POST['medico'];
        $id_paciente = $_POST['id_paciente'];

        $id = $this->model->createTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
        $this->view->showTurnById($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
    }

    public function deleteTurns($id) {
        $turn = $this->model->getTurns($id);

        if (!$turn) {
            return $this->view->showHome();
        }
        $this->model->eraseTurns($id);   //consultar acá
    }

    public function updateTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente){
        $turn = $this->model->getTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);

        if (!$turn) {
            return $this->view->showHome();
        }

        // actualiza la tarea
        $this->model->finishTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
    }
}