<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Appuntamento */
/* @var $form ActiveForm */

$this->title = 'Visualizza andamento terapie';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-appuntamenti">

    <div class="jumbotron bg-white">

        <h1><?= Html::encode($this->title) ?></h1>

        <table class="table table-bordered table-condensed table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Nome bambino</th>
                <th scope="col">Cognome bambino</th>
                <th scope="col">Esercizi svolti</th>
                <th scope="col">Esercizi da svolgere</th>
                <th scope="col">Totale esercizi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i = 0; $i < $numero; $i++) {
                echo "<tr>";
                echo "<td>";
                echo $bambini[$i]['nome'];
                echo "</td>";
                echo "<td>";
                echo $bambini[$i]['cognome'];
                echo "</td>";
                echo "<td>";
                echo $bambini[$i]['esercizi_svolti'];
                echo "</td>";
                echo "<td>";
                echo $bambini[$i]['esercizi_totali'] - $bambini[$i]['esercizi_svolti'];
                echo "</td>";
                echo "<td>";
                echo $bambini[$i]['esercizi_totali'];
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>