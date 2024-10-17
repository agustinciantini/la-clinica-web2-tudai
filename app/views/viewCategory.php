<?php
class viewCategory{
    public function showHome(){     //imprime HOME (index)
        require_once './templates/index/presentation.phtml'; 
    }
    public function showFAQ(){    // imprime las preguntas y respuestas.
        require_once './templates/faq.phtml'; 
    }
    public function showCategories($categories){     //imprime pacientes (categorias)
        require_once './templates/tablas/tableCategories.phtml';
    }
    public function showTurnsByIdCategory($turns){  
        require_once './templates/tablas/turnsByIdCategory.phtml'; //Imprime los items asociados a la categoria.
    }
    public function showError($error) {  //Imprime error.
        require 'templates/error.phtml';
    }
}