<?php

use yii\bootstrap4\Html;

/** @var yii\web\View $this */

$this->title = 'Visualizza contatti bambini';
?>
<div class="logopedista-visualizza-contatti-bambini">

    <div class="jumbotron bg-white">
        <h1 class="display-5"><b>LISTA CONTATTI BAMBINI</b></h1>
        <br>
        <table class="table table-bordered table-condensed table-striped table-hover">
            <caption>Contatti</caption>
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">telefono</th>
            </tr>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < $numero; $i++) {
                echo "<tr>";
                echo "<td>";
                echo $contatti[$i]['id'];
                echo "</td>";
                echo "<td>";
                echo $contatti[$i]['nome'];
                echo "</td>";
                echo "<td>";
                echo $contatti[$i]['cognome'];
                echo "</td>";
                echo "<td>";
                echo $contatti[$i]['email'];
                echo "</td>";
                echo "<td>";
                echo $contatti[$i]['telefono'];
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>