<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Appuntamento */
/* @var $form ActiveForm */

$this->title = 'Aggiungi diagnosi';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-appuntamenti">

    <div class="jumbotron bg-white">

        <h1><?= Html::encode($this->title) ?></h1>

        <p><b>Inserisci l'ID del bambino di cui inserire la diagnosi.</b></p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
                'inputOptions' => ['class' => 'col-lg-3 form-control', 'autocomplete' => 'off'],
                'errorOptions' => ['class' => 'col-lg-6 invalid-feedback'],
            ],
        ]); ?>

        <?php
            if($sentinella == true) {
                echo "<h5><b style = 'color:red' > ID inserito non valido. </b></h5>";
            }

        ?>

        <?= $form->field($model, 'id_bambino')->textInput() ?>

        <table class="table table-bordered table-condensed table-striped table-hover">
            <caption></caption>
            <thead>
            <tr>
                <th scope="col">ID bambino</th>
                <th scope="col">Nome bambino</th>
                <th scope="col">Cognome bambino</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i = 0; $i < $numero; $i++) {
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
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

        <p><b>Inserisci la diagnosi.</b></p>

        <?= $form->field($model, 'contenuto_diagnosi')->textarea(['rows' => '10']) ?>

        <div class="form-group">
            <?= Html::submitButton('Inserisci', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>