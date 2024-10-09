<?php
require_once './app/models/modelTurns.php';
require_once './app/views/viewTurns.php';
class controllerTurns{
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
    public function createTurns(){
        if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
            return $this->view->showHome(); // crear msj de error
        }
        if (!isset($_POST['hora']) || empty($_POST['hora'])) {
            return $this->view->showHome();
        }

        //$id = $_POST['id'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $consultorio = $_POST['consultorio'];
        $medico = $_POST['medico'];
        $id_paciente = intval($_POST['id_paciente']);
        var_dump($fecha, $hora, $consultorio, $medico, $id_paciente);

        $turn = $this->model->createTurns($fecha, $hora, $consultorio, $medico, $id_paciente);
        $this->view->showTurnById($turn);
    }
    public function deleteTurns($id) {
        $turn = $this->model->getTurnById($id);
        
        if (!$turn) {
            return $this->view->showHome();
        }
        $this->model->deleteTurns($id);
        header('Location:'. BASE_URL . 'home');
    }

    public function updateTurns($id){
        $turn = $this->model->getTurnById($id);

        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $consultorio = $_POST['consultorio'];
        $medico = $_POST['medico'];
        $id_paciente = intval($_POST['id_paciente']);

        if (!$turn) {
            return $this->view->showHome();
        }
        $this->model->updateTurns($id,$fecha, $hora, $consultorio, $medico, $id_paciente );
        header('Location:'. BASE_URL . 'home');

        if (!$turn) {
            return $this->view->showHome();
        }
    }
}