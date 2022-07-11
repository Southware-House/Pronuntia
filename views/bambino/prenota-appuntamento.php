<?php
/* @var $this \yii\web\View */
/* @var $model app\models\Appuntamento */

use bootui\datetimepicker\Datepicker;
use bootui\datetimepicker\Timepicker;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
$this->title = 'Aggiungi Appuntamento';
?>
<div>
<div class="bg-white jumbotron text-center">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Inserisci la data e l'ora dell'appuntamento</p>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control', 'autocomplete' => 'off'],
            'errorOptions' => ['class' => 'col-lg-6 invalid-feedback'],
        ],
    ]); ?>
    <?= $form->field($model, 'data_appuntamento')->textInput()->widget(Datepicker::className(),[
        'options' => ['format' => 'YYYY-MM-DD'],
    ]); ?>
    <?= $form->field($model, 'orario_appuntamento')->textInput()->widget(Timepicker::className(), [
        'options' => ['format' => 'HH:mm:ss'],
    ]); ?>
    <?= $form->field($model, 'note')->textarea(['rows' => '6']) ?>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>