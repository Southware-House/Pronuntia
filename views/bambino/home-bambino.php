<?php


/** @var yii\web\View $this */

use app\controllers\SiteController;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

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
                    <?= $form->field($model, 'passwd_caregiver')->textInput() ?>
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