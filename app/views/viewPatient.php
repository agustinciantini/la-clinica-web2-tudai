<?php
class viewPatient{
    public function showCategories($categories){     //imprimir pacientes (categorias)
        require_once './templates/tablas/tableCategories.phtml';
    }
}