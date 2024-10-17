<?php
require_once './app/models/modelTurns.php';
require_once './app/views/viewTurns.php';
require_once './app/models/modelCategory.php';
require_once './app/views/viewCategory.php';
require_once './app/models/modelDeploy.php';

class controllerTurns{
    private $view;
    private $model;
    private $modelCategory;
    private $viewCategory;

    public function __construct(){
        $this->view = new ViewTurns();
        $this->model = new ModelTurns();
        $this->modelCategory = new modelCategory();
        $this->viewCategory = new viewCategory();
    }
    public function showHome(){  //Muestra el home.
        $this->view->showHome();
    }
    public function showFaq(){  //Muestra faq.
        $this->view->showFaq();
    }
    public function getTurns(){  //Obtiene ítems a mostrar y las categorias para el select.
        $turns = $this->model->getTurns();
        $categories = $this->modelCategory->getCategories();
        $this->view->showTurns($turns, $categories);
    }
    public function getTurnById($id) { //Obtiene un ítem según ID y la categoria para
        $turn = $this->model->getTurnById($id);//mostrar datos del paciente en detalles del turno.        
        if (!$turn) {
            return $this->view->showError("Ocurrió un error, ¡Vuelve a intentar!");
        }    
        $id_paciente = $turn->id_paciente; 
        $paciente = $this->modelCategory->getCategoryById($id_paciente);     
        return $this->view->showTurnById($turn, $paciente); 
    }
    public function getTurnsByIdCategory($id){ //Obtiene ítems según ID de la categoría.
        $turns = $this->model->getTurnsByIdCategory($id);
        if(!$turns){
            return $this->view->showError("Ocurrió un error, ¡Vuelve a intentar!");
        }
        $this->viewCategory->showTurnsByIdCategory($turns);//Turnos asociados a la categoria.
    }
    public function createTurns(){  //Pasa datos para crear un ítem en la db.
        //Autenticacion de los datos ingresados por el formulario.
        if($this->authForm()){
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $consultorio = $_POST['consultorio'];
            $medico = $_POST['medico'];
            $id_paciente = $_POST['id_paciente'];
            $turn = $this->model->createTurns($fecha, $hora, $consultorio, $medico, $id_paciente);
            header('Location:'. BASE_URL . 'turnos');
        }else{
            $this->view->showError(error: "Completar campos!");
        }
    }
    public function deleteTurns($id) {  //Obtiene un ítem según ID a borrar.
        $turn = $this->model->getTurnById($id);
        
        if (!$turn) {
            return $this->view->showHome();
        }
        $this->model->deleteTurns($id);
        header('Location:'. BASE_URL . 'turnos');
    }

    public function updateTurns($id){  //Obtiene un ítem según ID a editar.
        $turn = $this->model->getTurnById($id);
        if (!$turn) {
            return $this->view->showError("Ocurrio un error, ¡Vuelve a intentar!");
        }
        //Autenticacion de los datos ingresados por el formulario.
        if ($this->authForm()) {
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $consultorio = intval($_POST['consultorio']);
            $medico = $_POST['medico'];
    
            $this->model->updateTurns($id, $fecha, $hora, $consultorio, $medico);
            header('Location:'. BASE_URL . 'turnos');    
        } else{
            $this->view->showError(error: "Completar campos!");
        }
    }
    public function authForm(){
     //Si no esta seteado o esta vacio.
     if (!isset($_POST['fecha']) || empty($_POST['fecha']) ||
     !isset($_POST['hora']) || empty($_POST['hora'])||
     !isset($_POST['consultorio']) || empty($_POST['consultorio']) ||
     !isset($_POST['medico']) || empty($_POST['medico']) ) {
        return false;
    }
    return true;
}
}