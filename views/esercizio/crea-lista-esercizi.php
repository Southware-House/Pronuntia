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
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'nome')->textInput() ?>

    <div class="row align-items-center">
        <div class="col">
            <b>ID Esercizio</b>
            <?php
            for ($i = 0; $i < $numero_esercizi; $i++) {
                echo "<br>";
                echo $esercizi[$i]['id'];
                echo "<br>";
            }
            ?>
        </div>
        <div class="col">
            <b>Titolo Esercizio</b>
            <?php
            for ($i = 0; $i < $numero_esercizi; $i++) {
                echo "<br>";
                echo $esercizi[$i]['titolo'];
                echo "<br>";
            }
            ?>
        </div>
        <div class="col">

        </div>
    </div>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Crea lista esercizi', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
