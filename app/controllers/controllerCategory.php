<?php
require_once './app/models/Modelcategory.php';
require_once './app/views/viewCategory.php';
require_once './app/models/modelDeploy.php';

class controllerCategory{
    private $view;
    private $model;
    public function __construct(){
        $this->view = new viewCategory();
        $this->model = new Modelcategory();
    }
    public function getCategories(){  //Obtiene categorias a mostrar.
        $categories = $this->model->getCategories();
        $this->view->showCategories($categories);
    }
    public function createCategories(){  //Pasa datos para crear una categoría en la db.
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
    public function deleteCategories($id) { //Obtiene categoría a borar.
        $category = $this->model->getCategoryById($id);
        
        if (!$category) {
            return $this->view->showHome();
        }
        $this->model->deleteCategories($id);
        header('Location:'. BASE_URL . 'home');
    }
    public function updateCategories($id){  //Obtiene categoría a editar.
        $category = $this->model->getCategoryById($id);
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