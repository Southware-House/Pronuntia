<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelBambino app\models\Bambino */
/* @var $modelListaEsercizi app\models\ListaEsercizi */
/* @var $form ActiveForm */
$this->title = 'Assegnazione lista esercizi';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="esercizio-assegnazione-lista-esercizi">

    <div class="jumbotron bg-white">

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

    <br>
    <b>Inserire nel campo seguente l'<u>ID</u> della lista che si vuole assegnare al bambino.</b>
    <br>
    <br>
    <?= $form->field($model, 'id_lista')->textInput() ?>
    <br>

    <table class="table table-bordered table-condensed table-striped table-hover">
        <caption>Liste disponibili</caption>
        <thead>
        <tr>
            <th scope="col">ID lista</th>
            <th scope="col">Nome lista</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < $numeroListe; $i++) {
            echo "<tr>";
            echo "<td>";
            echo $liste[$i]['id'];
            echo "</td>";
            echo "<td>";
            echo $liste[$i]['nome'];
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <br>
    <b>Inserire nel campo seguente l'<u>ID</u> del bambino a cui si vuole assegnare la lista di esercizi.</b>
    <br>
    <br>
    <?= $form->field($model, 'id_bambino')->textInput() ?>
    <br>

    <table class="table table-bordered table-condensed table-striped table-hover">
        <caption>Lista bambini in cura</caption>
        <thead>
        <tr>
            <th scope="col">ID bambino</th>
            <th scope="col">Nome</th>
            <th scope="col">Cognome</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < $numeroBambini; $i++) {
            echo "<tr>";
            echo "<td>";
            echo $bambini[$i]['id'];
            echo "</td>";
            echo "<td>";
            echo $bambini[$i]['nome'];
            echo "</td>";
            echo "<td>";
            echo $bambini[$i]['cognome'];
            echo "</td>";
            echo "<td>";
            echo $bambini[$i]['email'];
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Assegna', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    </div>
</div>