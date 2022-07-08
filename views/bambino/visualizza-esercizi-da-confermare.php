<?php

/** @var yii\web\View $this */

use app\controllers\SiteController;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Home';
?>
<div class="bambino-visualizza-esercizi-da-confermare">

    <div class="jumbotron bg-white">

    <br>
    <b><h4>Tabella degli esercizi</h4></b>
    <br>

    <table class="table table-bordered table-condensed table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Nome lista</th>
            <th scope="col">ID esercizio</th>
            <th scope="col">Titolo</th>
            <th scope="col">Traccia</th>
            <th scope="col">Svolgimento</th>
            <th scope="col">Conferma caregiver</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < $numeroListe; $i++) {
            echo "<tr>";
            echo "<td>";
            echo '<b>' . $liste[$i]['nome'] . '</b>';
            echo "</td>";
            echo "</tr>";
            for ($j = 0; $j < $numeroEsercizi; $j++) {
                if($esercizi[$j]['id_lista_esercizi'] == $liste[$i]['id']) {
                    echo "<tr>";
                    echo "<td>";
                    echo "</td>";
                    echo "<td>";
                    echo $esercizi[$j]['id'];
                    echo "</td>";
                    echo "<td>";
                    echo $esercizi[$j]['titolo'];
                    echo "</td>";
                    echo "<td>";
                    echo $esercizi[$j]['traccia'];
                    echo "</td>";
                    echo "<td>";
                    if($esercizi[$j]['is_svolto'] == 0)
                        echo 'NO';
                    else
                        echo 'SI';
                    echo "</td>";
                    echo "<td>";
                    if($esercizi[$j]['conferma_caregiver'] == 0)
                        echo 'NO';
                    else
                        echo 'SI';
                    echo "</td>";
                    echo "</tr>";
                }
            }
        }
        ?>
        </tbody>
    </table>

    Inserire l'ID dell'esercizio di cui si vuole confermare lo svolgimento. N.B. Se si conferma lo svolgimento di un esercizio non svolto dal bambino, la conferma non avverrà.

    <br>
    <br>

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

    <?= $form->field($model, 'id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Conferma', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    </div>

</div>
