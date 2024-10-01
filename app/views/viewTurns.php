<?php

class viewTurns{
    public function showTurns($turns){
        require_once './templates/layout/header.php';   //Imprimir todos los turnos.

        require_once './templates/index/presentation.phtml'; //PROBLEMA; imprime tabla al final

        require_once './templates/layout/footer.php';
    }
    public function showTurnById($turn){      
        require_once './templates/layout/header.php';  //Imprimir el turno segun id.      
    
        require_once './templates/turnById.phtml'; //PROBLEMA; no trae estilo

        require_once './templates/layout/footer.php';
    }
    public function showCategories($categories){        
        //Imprimir categorias.
        require_once './templates/tableCategories.phtml';
    }

    public function showCreateTurns($create){         // Imprimir los turnos creados.

        
    }

    public function showDeleteTurns($delete){       // Imprimir los turnos borrados.

    }

    public function showUpdateTurns($update){        // Imprimir los turnos actualizados.

    }
}