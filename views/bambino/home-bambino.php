<?php


/** @var yii\web\View $this */

use app\controllers\SiteController;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Home';
?>
<div class="bambino-home-bambino">

    <div class="text-center bg-white">
        <br>
        <h1 class="display-4"><b>HOME</b></h1>
        <br>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">VISUALIZZA E SVOLGI LE LISTE DEGLI ESERCIZI</h5>
                    <p class="card-text">Visualizza le liste di esercizi assegnate al bambino e svolgile.</p>
                    <?= Html::beginForm(['/esercizio/visualizza-liste-da-svolgere'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">VALUTA LISTE DI ESERCIZI</h5>
                    <p class="card-text">Visualizza le liste di esercizi che il bambino deve valutare.</p>
                    <?= Html::beginForm(['/esercizio/visualizza-liste-da-valutare'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VALUTA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row" style="margin-left: 25%; margin-right: 25%">
        <div class="col-sm">
            <div class="card text-center">
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'options' => ['enctype' => 'multipart/form-data'],
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'col-lg-4 col-form-label mr-lg-3'],
                            'inputOptions' => ['class' => 'col-lg-6 form-control'],
                            'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
                        ],
                    ]); ?>
                    <h5 class="card-title">ACCESSO SEZIONE CAREGIVER</h5>
                    <p class="card-text">Inserisci la password per accedere alla sezione Caregiver</p>
                    <?= $form->field($model, 'passwd_caregiver')->passwordInput() ?>
                    <?php
                    if(isset($errore)) {
                        echo "<h5><b style = 'color:red' > Password errata </b></h5>";
                    }
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('ACCEDI', ['class' => 'submit']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>