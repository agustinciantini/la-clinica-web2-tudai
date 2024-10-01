<?php

class viewTurns{
    public function showHome(){ //IMPRIME HOME (index)
        require_once './templates/index/presentation.phtml'; 
    }
    public function showTurns($turns){ //imprime la tabla de turnos
        require_once './templates/index/tableTurns.phtml';
    }
    public function showTurnById($turn){      
        require_once './templates/turnById.phtml'; 
    }
    public function showCategories($categories){ //Imprimir categorias.
        require_once './templates/tableCategories.phtml';
    }

    public function showCreateTurns($create){      // Imprimir los turnos creados.

        
    }

    public function showDeleteTurns($delete){       // Imprimir los turnos borrados.

    }

    public function showUpdateTurns($update){        // Imprimir los turnos actualizados.

    }
}