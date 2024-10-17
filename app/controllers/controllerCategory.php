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
        //Autenticacion de los datos ingresados por el formulario.
        if($this->authForm()){
        $nombrePaciente = $_POST['nombrePaciente'];
        $apellidoPaciente = $_POST['apellidoPaciente'];
        $dniPaciente = $_POST['dniPaciente'];
        $edadPaciente = $_POST['edadPaciente'];
        $enfermedadPaciente = $_POST['enfermedadPaciente'];
        $medicoPaciente = $_POST['medicoPaciente'];
        $imgPaciente =$_POST ['imgPaciente'];

        $category = $this->model->createCategories($nombrePaciente, $apellidoPaciente, $dniPaciente, $edadPaciente, $enfermedadPaciente, $medicoPaciente, $imgPaciente);
        header('Location:'. BASE_URL . 'turnos');
    }else{
        $this->view->showError(error: "Completar campos!");
    }
    }
    public function deleteCategories($id) { //Obtiene una categoría por ID a borrar.
        $category = $this->model->getCategoryById($id);
        
        if (!$category) {
            return $this->view->showHome();
        }
        $this->model->deleteCategories($id);
        header('Location:'. BASE_URL . 'home');
    }
    public function updateCategories($id){  //Obtiene categoría por ID a editar.
        $category = $this->model->getCategoryById($id);
        if (!$category) {
            return $this->view->showHome();
        }

        //Autenticacion de los datos ingresados por el formulario.
        if($this->authForm()){
        $nombrePaciente = $_POST['nombrePaciente'];
        $apellidoPaciente = $_POST['apellidoPaciente'];
        $dniPaciente = intval($_POST['dniPaciente']);
        $edadPaciente = intval($_POST['edadPaciente']);
        $enfermedadPaciente = $_POST['enfermedadPaciente'];
        $medicoPaciente = $_POST['medicoPaciente'];
        $imgPaciente = $_POST['imgPaciente'];
      
        $this->model->updateCategories($id, $nombrePaciente, $apellidoPaciente, $dniPaciente, $edadPaciente, $enfermedadPaciente, $medicoPaciente, $imgPaciente);
        header('Location:'. BASE_URL . 'turnos');
    }else{
        $this->view->showError(error: "Completar campos!");
    }
    }
    public function authForm(){
        //Si no esta seteado o esta vacio.
        if (!isset($_POST['nombrePaciente']) || empty($_POST['nombrePaciente']) ||
         !isset($_POST['apellidoPaciente']) || empty($_POST['apellidoPaciente'])||
         !isset($_POST['dniPaciente']) || empty($_POST['dniPaciente']) ||
         !isset($_POST['edadPaciente']) || empty($_POST['edadPaciente']) ||
         !isset($_POST['enfermedadPaciente']) || empty($_POST['enfermedadPaciente']) ||
         !isset($_POST['medicoPaciente']) || empty($_POST['medicoPaciente'])) {
            return false;
        }
        return true;
    }
}