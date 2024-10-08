<?php
require_once './app/models/modelPatient.php';
require_once './app/views/viewPatient.php';

class controllerPatient{
    private $view;
    private $model;
    public function __construct(){
        $this->view = new viewPatient();
        $this->model = new ModelPatient();
    }
    public function getCategories(){  //Muestra categorias.
        $categories = $this->model->getCategories();
        $this->view->showCategories($categories);
    }
}