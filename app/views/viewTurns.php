<?php

class viewTurns{
    public function showHome(){     //imprime HOME (index)
        require_once './templates/index/presentation.phtml'; 
    }
    public function showTurns($turns){     //imprime la tabla de turnos (items)
        require_once './templates/tablas/tableTurns.phtml';
    }
    public function showTurnById($turn){      //imprime un turno segun id.
        require_once './templates/tablas/turnById.phtml'; 
    }
    public function showCategories($categories){     //Imprimir pacientes (categorias)
        require_once './templates/tablas/tableCategories.phtml';
    }

    public function showCreateTurns($create){     // Imprimir los turnos creados.

        
    }

    public function showDeleteTurns($delete){     // Imprimir los turnos borrados.

    }

    public function showUpdateTurns($update){     // Imprimir los turnos actualizados.

    }
}