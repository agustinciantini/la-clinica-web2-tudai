<?php

class viewTurns{
    public function showHome(){     //imprime HOME (index)
        require_once './templates/index/presentation.phtml'; 
    }
    public function showFAQ(){    // impre las preguntas y respuestas.
        require_once './templates/faq.phtml'; 
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
        require_once './templates/functions/createTurns.phtml';   
    }

    public function showDeleteTurns($delete){     // Imprimir los turnos borrados.
        require_once './templates/functions/deleteTurns.phtml';  
    }

    public function showUpdateTurns($update){     // Imprimir los turnos actualizados.
        require_once './templates/functions/updateTurns.phtml';  
    }
}