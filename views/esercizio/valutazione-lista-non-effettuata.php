<?php

/** @var yii\web\View $this */

use app\controllers\SiteController;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Conferma valutazione lista';
?>
<div class="esercizio-valutazione-lista-effettuata">

    <div class="jumbotron bg-white">

    <br>
    <h5><b style = 'color:red' >Valutazione lista esercizi già effetteuata.</b></h5>
    <br>

    <?= Html::beginForm(['/bambino/home-bambino'], 'post', ['enctype' => 'multipart/form-data']) ?>
    <?= Html::submitButton('TORNA ALLA HOME', ['class' => 'submit']) ?>
    <?= Html::endForm() ?>
    </div>

</div>