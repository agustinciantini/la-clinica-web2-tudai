<?php
class viewCategory{
    public function showHome(){     //imprime HOME (index)
        require_once './templates/index/presentation.phtml'; 
    }
    public function showFAQ(){    // imprime las preguntas y respuestas.
        require_once './templates/faq.phtml'; 
    }
    public function showCategories($categories){     //imprimir pacientes (categorias)
        require_once './templates/tablas/tableCategories.phtml';
    }
}