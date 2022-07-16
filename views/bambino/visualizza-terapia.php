<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form ActiveForm */

$this->title = 'Visualizza andamento terapia';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-terapia">

    <div class="jumbotron bg-white">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php
        if($dati){
            echo "<h5><b style = 'color:#00ff5d' > Esercizi svolti: " . $dati['esercizi_svolti'] . "</b></h5>";
            echo "<h5><b style = 'color:red' > Esercizi da svolgere: " . ($dati['esercizi_totali'] - $dati['esercizi_svolti']) . "</b></h5>";
            echo "<h5><b style = 'color:#0022ff' > Totale esercizi: " . $dati['esercizi_totali'] . "</b></h5>";
        } else {
            echo "<h5><b style = 'color:#00ff5d' > Esercizi svolti: " . '0' . "</b></h5>";
            echo "<h5><b style = 'color:red' > Esercizi da svolgere: " . '0' . "</b></h5>";
            echo "<h5><b style = 'color:#0022ff' > Totale esercizi: " . '0' . "</b></h5>";
        }
        ?>


    </div>
</div>