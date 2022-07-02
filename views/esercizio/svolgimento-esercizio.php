<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
// rivedere riga 8, se non serve -> cancellare
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
    <br>
    <?php echo Html::img('@web/images/29d2abad6eac900308d7e3182c37e8ff.png') ?>

</div>
