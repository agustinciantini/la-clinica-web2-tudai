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
    public function getTurns(){  //Obtiene ítems a mostrar.
        $turns = $this->model->getTurns();
        $categories = $this->modelCategory->getCategories();
        $this->view->showTurns($turns, $categories);
    }
    public function getTurnById($id) { //Obtiene un ítem según ID.
        $turn = $this->model->getTurnById($id);        
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
            //$_SESSION==null
        }
        $this->viewCategory->showTurnsByIdCategory($turns);
    }
    public function createTurns(){  //Pasa datos para crear un ítem en la db.
        if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
            return $this->view->showError("Ocurrio un error, ¡Vuelve a intentar!");

        }
        if (!isset($_POST['hora']) || empty($_POST['hora'])) {
            return $this->view->showError("Ocurrio un error, ¡Vuelve a intentar!");
        }

        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $consultorio = $_POST['consultorio'];
        $medico = $_POST['medico'];
        //Si no hay categorias(no tiene id_paciente) no puede hacer un turno.
        if(!isset($_POST['id_paciente'])){
            $this->view->showError("NO HAY CATEGORIAS");
        }else{
            $id_paciente = $_POST['id_paciente'];
            $turn = $this->model->createTurns($fecha, $hora, $consultorio, $medico, $id_paciente);
        header('Location:'. BASE_URL . 'turnos');
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
        if (!isset($_POST['fecha']) || empty($_POST['fecha']) || 
        !isset($_POST['hora']) || empty($_POST['hora']) || 
        !isset($_POST['consultorio']) || empty($_POST['consultorio']) || 
        !isset($_POST['medico']) || empty($_POST['medico'])) {
            return $this->view->showError("Ocurrio un error, complete los campos necesarios.");
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