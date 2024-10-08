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
        $turn = $this->model->getTurnById($id);
        $this->view->showTurnById($turn);
    }
    public function getCategories(){  //Muestra categorias.
        $categories = $this->model->getCategories();
        $this->view->showCategories($categories);
    }
    public function createTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente){
        $create = $this->model->createTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
        $this->view->showTurnById($id);
    }
    public function deleteTurns($id){
        $delete = $this->model->deleteTurns($id);
    }
    public function updateTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente){
        $update = $this->model->updateTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
        $this->view->showTurnById($id);
    }
}