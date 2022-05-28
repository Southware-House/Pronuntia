<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bambino */
/* @var $form ActiveForm */
?>
<div class="site-registerb">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id') ?>
        <?= $form->field($model, 'età') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'passwd') ?>
        <?= $form->field($model, 'nome') ?>
        <?= $form->field($model, 'cognome') ?>
        <?= $form->field($model, 'indirizzo') ?>
        <?= $form->field($model, 'telefono') ?>
        <?= $form->field($model, 'passwd_caregiver') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-registerb -->
