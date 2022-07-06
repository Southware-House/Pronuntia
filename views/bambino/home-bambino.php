<?php


/** @var yii\web\View $this */

use app\controllers\SiteController;
use yii\helpers\Html;

$this->title = 'Home';
?>
<div class="bambino-home-bambino">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">HOME BAMBINO</h1>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">VISUALIZZA LISTE DA SVOLGERE</h5>
                    <p class="card-text">Visualizza le liste di esercizi che il bambino deve svolgere.</p>
                    <?= Html::beginForm(['/esercizio/visualizza-liste-da-svolgere'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">prova</h5>
                    <p class="card-text">prova</p>
                    <?= Html::beginForm([''], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('prova', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>

</div>