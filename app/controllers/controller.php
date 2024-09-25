<?php
require_once './app/models/model.php';
require_once './app/views/view.php';
class controller{
    private $view;
    private $model;

    public function __construct(){
        $this->view = new View();
        $this->model = new Model();
    }
    public function getTurns(){
        $turns = $this->model->getTurns();
        $this->view->showTurns($turns);
    }
    public function getTurnById($id){
        $turn= $this->model->getTurnById($id);
        $this->view->showTurnById($turn);
    }
    public function getCategories(){
        $categories = $this->model->getCategories();
        $this->view->showCategories($categories);
    }
}