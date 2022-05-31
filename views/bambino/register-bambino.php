<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bambino */
/* @var $form ActiveForm */
$this->title = 'Registrazione bambino';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="bambino-register-bambino">
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

        <?= $form->field($model, 'id')->textInput() ?>
        <?= $form->field($model, 'età')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'passwd')->passwordInput() ?>
        <?= $form->field($model, 'nome')->textInput() ?>
        <?= $form->field($model, 'cognome')->textInput() ?>
        <?= $form->field($model, 'indirizzo')->textInput() ?>
        <?= $form->field($model, 'telefono')->textInput() ?>
    <p><b>Inserire nel campo seguente la password per accedere alla sezione del caregiver:</b></p>
        <?= $form->field($model, 'passwd_caregiver')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
