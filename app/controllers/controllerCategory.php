<?php
require_once './app/models/Modelcategory.php';
require_once './app/views/viewCategory.php';

class controllerCategory{
    private $view;
    private $model;
    public function __construct(){
        $this->view = new viewCategory();
        $this->model = new Modelcategory();
    }
    public function getCategories(){  //Muestra categorias.
        $categories = $this->model->getCategories();
        $this->view->showCategories($categories);
    }
    public function deleteCategories($id) {
        $category = $this->model->getCategoryById($id);
        
        if (!$category) {
            return $this->view->showHome();
        }
        $this->model->deleteCategories($id);
        header('Location:'. BASE_URL . 'home');
    }
    public function createCategories(){
        if (!isset($_POST['nombrePaciente']) || empty($_POST['nombrePaciente'])) {
            return $this->view->showError(error: "Ocurrio un error, ¡Vuelve a intentar!.");
        }
        if (!isset($_POST['apellidoPaciente']) || empty($_POST['apellidoPaciente'])) {
            return $this->view->showError(error: "Ocurrio un error, ¡Vuelve a intentar!.");
        }
        $nombrePaciente = $_POST['nombrePaciente'];
        $apellidoPaciente = $_POST['apellidoPaciente'];
        $dniPaciente = $_POST['dniPaciente'];
        $edadPaciente = $_POST['edadPaciente'];
        $enfermedadPaciente = $_POST['enfermedadPaciente'];
        $medicoPaciente = $_POST['medicoPaciente'];

        $category = $this->model->createCategories($nombrePaciente, $apellidoPaciente, $dniPaciente, $edadPaciente, $enfermedadPaciente, $medicoPaciente);
        $this->view->showHome();
    }
    public function updateCategories($id){
        $category = $this->model->getCategoryById($id);
        //tare todos los datos como string.
        var_dump($category);
        if (!$category) {
            return $this->view->showHome();
        }

        $nombrePaciente = $_POST['nombrePaciente'];
        $apellidoPaciente = $_POST['apellidoPaciente'];
        $dniPaciente = intval($_POST['dniPaciente']);
        $edadPaciente = intval($_POST['edadPaciente']);
        $enfermedadPaciente = $_POST['enfermedadPaciente'];
        $medicoPaciente = $_POST['medicoPaciente'];

      
        $this->model->updateCategories($id, $nombrePaciente, $apellidoPaciente, $dniPaciente, $edadPaciente, $enfermedadPaciente, $medicoPaciente);
        header('Location:'. BASE_URL . 'turnos');
    }
}