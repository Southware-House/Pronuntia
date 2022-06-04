<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Errore creazione lista esericizi';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="esercizio-errore-lista-esercizi">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <div class="container">
        <br>
        <b>L'ID esercizio inserito nella lista esercizi non è valido.</b>
        <br>
        <br>
        <?= Html::beginForm(['/logopedista/home-logopedista'], 'post', ['enctype' => 'multipart/form-data']) ?>
            <?= Html::submitButton('HOME', ['class' => 'submit']) ?>
        <?= Html::endForm() ?>
    </div>
</div>