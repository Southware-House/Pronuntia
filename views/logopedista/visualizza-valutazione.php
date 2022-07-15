<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Appuntamento */
/* @var $form ActiveForm */

$this->title = 'Visualizza indice di gradimento';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-appuntamenti">

    <div class="jumbotron bg-white">

        <h1><?= Html::encode($this->title) ?></h1>

        <table class="table table-bordered table-condensed table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">ID lista esercizi</th>
                <th scope="col">Nome lista esercizi</th>
                <th scope="col">Media delle valutazioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i = 0; $i < $numero; $i++) {
                echo "<tr>";
                echo "<td>";
                echo $liste[$i]['id_lista_esercizi'];
                echo "</td>";
                echo "<td>";
                echo $liste[$i]['nome'];
                echo "</td>";
                echo "<td>";
                echo $liste[$i]['voto'];
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>