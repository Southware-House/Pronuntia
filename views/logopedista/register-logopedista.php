<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Logopedista */
/* @var $form ActiveForm */
$this->title = 'Registrazione logopedista';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="logopedista-register-logopedista">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        <?php
        if(isset($_GET['check'])) {
            echo '<b style = \'color:red\' > Email già esistente. Inserire un\'altra email.</b><br><br> ';
        }
        ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'passwd')->passwordInput() ?>
        <?= $form->field($model, 'cognome')->textInput() ?>
        <?= $form->field($model, 'nome')->textInput() ?>
        <?= $form->field($model, 'indirizzo')->textInput() ?>
        <?= $form->field($model, 'telefono')->textInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
