<?php

class viewTurns{
    public function showHome(){     //imprime HOME (index)
        require_once './templates/index/presentation.phtml'; 
    }
    public function showFAQ(){    // imprime las preguntas y respuestas.
        require_once './templates/faq.phtml'; 
    }
    public function showTurns($turns){     //imprime la tabla de turnos (items)
        require_once './templates/tablas/tableTurns.phtml';
    }
    public function showTurnById($turn){      //imprime un turno segun id.
        require_once './templates/tablas/turnById.phtml'; 
    }
}