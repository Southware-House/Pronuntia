<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Esercizio */
/* @var $form ActiveForm */
$this->title = 'Svolgimento esercizio';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="svolgimento-esercizio">

    <?php
    $titolo = $esercizio['titolo'];
    $traccia = $esercizio['traccia'];

    echo "<h4><b style = 'color:seagreen' > $titolo </b></h4>";
    ?>

    <?=$traccia?>

    <div>
        <br>

        <?php
            if($numeroImmagini > 0) {
                echo '<b>Immagini</b>';
                echo '<br>';
                echo '<br>';
                for($i = 0; $i < $numeroImmagini; $i++) {
                    echo Html::img("@web/images/esercizi/" . $emailLogopedisti[$i] . "/" . $nomeImmagini[$i], array('width'=>250, 'height'=>'auto', 'style'=>"border:1px solid black"));
                    echo " ";
                }
            }
        ?>
    </div>

    <br>

    <div>
        <?php
            if($numeroAudio > 0) {
                echo '<b>File audio</b>';
                echo '<br>';
                echo '<br>';
                for($i = 0; $i < $numeroAudio; $i++) {
                    echo '<audio controls>';
                    echo '<source src="audio/esercizi/' . $emailLogopedistiAudio[$i] . '/' . $nomeAudio[$i] . '" type="audio/mpeg">';
                    echo 'Your browser does not support the audio element.';
                    echo '</audio>';
                }
            }
        ?>
    </div>

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data'],
        'action' => ['esercizio/svolgimento-esercizio', 'id' => $esercizio['id'], 'setSvolto' => true],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <br>
    <br>
    <!-- inserire pulsante che conferma svolgimento esercizio e rimanda alla vista esercizi lista -->
    <div class="form-group">
        <?= Html::submitButton('Conferma', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
