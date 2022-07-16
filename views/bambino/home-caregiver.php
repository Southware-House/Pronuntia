<?php


/** @var yii\web\View $this */
/** @var \app\models\Bambino $model */

use app\controllers\SiteController;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\Bambino;

$this->title = 'Home';
?>
<div class="bambino-home-caregiver">

    <div class="text-center">
        <br>
        <h1 class="display-4">Sezione Caregiver [<b><?php echo $model::findOne(['id' => explode('-', Yii::$app->user->identity->getId())[1]])->nome ?></b>]</h1>
        <br>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-6">
            <div class="card bg-light mb-3 text-center">
                <div class="card-body">
                    <h5 class="card-title">CONFERMA SVOLGIMENTO ESERCIZI</h5>
                    <p class="card-text">Conferma lo svolgimento degli esercizi che il bambino ha svolto.</p>
                    <?= Html::beginForm(['/bambino/visualizza-esercizi-da-confermare'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card bg-light mb-3 text-center">
                <div class="card-body">
                    <h5 class="card-title">CONTATTA LOGOPEDISTA</h5>
                    <p class="card-text">Visualizza l'e-mail del logopedista.</p>
                    <?= Html::beginForm(['/bambino/email-logopedista'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>

    </div>

    <br>

    <div class="row">
        <div class="col-sm-6">
            <div class="card bg-light mb-3 text-center">
                <div class="card-body">
                    <h5 class="card-title">PRENOTA APPUNTAMENTO</h5>
                    <p class="card-text">Prenota un'appuntamento con il logopedista</p>
                    <?= Html::beginForm(['/bambino/prenota-appuntamento'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('PRENOTA', ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card bg-light mb-3 text-center">
                <div class="card-body">
                    <h5 class="card-title">VISUALIZZA APPUNTAMENTI</h5>
                    <p class="card-text">Visualizza gli appuntamenti con il logopedista</p>
                    <?= Html::beginForm(['/bambino/visualizza-appuntamenti'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card bg-light mb-3 text-center">
                <div class="card-body">
                    <h5 class="card-title">VISUALIZZA TERAPIA</h5>
                    <p class="card-text">Visualizza l'andamento della terapia del bambino.</p>
                    <?= Html::beginForm(['/bambino/visualizza-terapia'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
