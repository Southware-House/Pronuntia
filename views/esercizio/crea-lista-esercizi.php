<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ListaEsercizi */
/* @var $form ActiveForm */
$this->title = 'Creazione lista esercizi';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="esercizio-crea-lista-esercizi">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'nome')->textInput() ?>
    <br>
    <b>Inserire nel campo seguente gli ID degli esercizi che si vogliono aggiungere alla lista nel formato: 3,18,15,28</b>
    <br>
    <br>
    <?= $form->field($model, 'lista_id')->textInput() ?>
    <br>

    <table class="table table-bordered table-condensed table-striped table-hover">
        <caption>Lista di esercizi disponibili</caption>
        <thead>
        <tr>
            <th scope="col">ID Esercizio</th>
            <th scope="col">Titolo Esercizio</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < $numero_esercizi; $i++) {
            echo "<tr>";
            echo "<td>";
            echo $esercizi[$i]['id'];
            echo "</td>";
            echo "<td>";
            echo $esercizi[$i]['titolo'];
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Crea lista esercizi', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
