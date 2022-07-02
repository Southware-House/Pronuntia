<?php

use yii\db\Connection;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $listaEsercizi app\models\ListaEsercizi */
/* @var $form ActiveForm */
$this->title = 'Visualizza esercizi lista';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-esercizi-lista">

    <table class="table table-bordered table-condensed table-striped table-hover">
        <caption></caption>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Traccia</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < $numeroEsercizi; $i++) {
            echo "<tr>";
            echo "<td>";
            echo $esercizi[$i]['id'];
            echo "</td>";
            echo "<td>";
            echo $esercizi[$i]['titolo'];
            echo "</td>";
            echo "<td>";
            echo $esercizi[$i]['traccia'];
            echo "</td>";
            echo "</tr>";
        }
        ?>

        </tbody>
    </table>

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    Seleziona l'<u>ID</u> dell'esercizio da svolgere
    <br>
    <br>

    <?= $form->field($model, 'id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Svolgi', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>