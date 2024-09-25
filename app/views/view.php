<?php

class view{
    public function showTurns($turns){
        //Imprimir todos los turnos.
        ?>
        <td>Id</td><td>Fecha</td><td>Hora</td><td>Consultorio</td>
        <br>
        <?php
        foreach ($turns as $turn) {
            ?>
            <li><a href="detalle/<?=$turn->id?>"><?= $turn->id. $turn->fecha.$turn->hora.$turn->consultorio?></a></li>
            <?php /*<li><a href="detalle/<?=$turn->id?>"><?= $turn->fecha?></a></li>
            <li><a href="detalle/<?=$turn->id?>"><?= $turn->hora?></a></li>
            <li><a href="detalle/<?=$turn->id?>"><?= $turn->consultorio?></a></li>*/ ?>
            
            <?php
        }
    }
    public function showTurnById($turn){
        //Imprimir el turno segun id.
        ?>
        <h3>Listar Item.</h3>
        <td>Id</td><td>Fecha</td><td>Hora</td><td>Consultorio</td><td>Medico</td><td>Id paciente</td>
        <br>
            <li><?= $turn->id.$turn->fecha.$turn->hora.$turn->consultorio.$turn->medico.$turn->id_paciente?></li>
           <?php /* <li><?= $turn->fecha?></li>
            <li><?= $turn->hora?></li>
            <li><?= $turn->consultorio?></li>
            <li><?= $turn->medico?></li>
            <li><?= $turn->id_paciente?></li>
            */ ?>
        <?php
    }
    public function showCategories($categories){
        //Imprimir categorias.
        ?>
        <td>Id</td><td>Nombre</td><td>Apellido</td><td>Edad</td><td>Enfermedad</td><td>Medico</td>
        <br>
        <?php
        foreach ($categories as $category) {
            ?>
            <li><?=$category->id.$category->nombre.$category->apellido.$category->dni.$category->edad.$category->enfermedad.$category->medico?></li>
            <?php /*<li><?=$category->nombre?></li>
            <li><?=$category->apellido?></li>
            <li><?=$category->edad?></li>
            <li><?=$category->enfermedad?></li>
            <li><?=$category->medico?></li>*/?>
            <?php
        }
    }
}