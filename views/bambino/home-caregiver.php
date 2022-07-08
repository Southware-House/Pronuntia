<?php


/** @var yii\web\View $this */

use app\controllers\SiteController;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Home';
?>
<div class="bambino-home-caregiver">

    <div class="jumbotron text-center bg-white">
        <h1 class="display-4">HOME CAREGIVER</h1>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">CONFERMA SVOLGIMENTO ESERCIZI</h5>
                    <p class="card-text">Conferma lo svolgimento degli esercizi che il bambino ha svolto.</p>
                    <?= Html::beginForm(['/bambino/visualizza-esercizi-da-confermare'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">CONTATTA LOGOPEDISTA</h5>
                    <p class="card-text">Visualizza l'e-mail del logopedista.</p>
                    <?= Html::beginForm(['/bambino/email-logopedista'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>

</div>
