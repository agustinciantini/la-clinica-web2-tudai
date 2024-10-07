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
        $create = $this->model->createTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
        $this->view->showTurnById($id);
    }
    public function deleteTurns($id){
        $delete = $this->model->deleteTurns($id);
    //  $this->view->showCategories($categories);
    }
    public function updateTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente){
        $update = $this->model->updateTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
        $this->view->showTurnById($id);
    }
}