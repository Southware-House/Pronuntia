<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use hosanna\audiojs\AudioJs;

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
            for($i = 0; $i < $numeroImmagini; $i++) {
                echo Html::img("@web/images/esercizi/logopedista@g.c/" . $nomeImmagini[$i], array('width'=>250, 'height'=>'auto', 'style'=>"border:1px solid black"));
                echo " ";
            }
        ?>
    </div>

        <!--inserire audio-->
        <?php
        $audiojs = new AudioJs();
        $audiojs->uploads = 'audio/esercizi/francescorossi@gmail.com/b84954cb41831fa842dd69f6e1836b6e.mp3';
        ?>

        <?= $audiojs->run() ?>

</div>
