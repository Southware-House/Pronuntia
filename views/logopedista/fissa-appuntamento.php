<?php
/* @var $this \yii\web\View */
/* @var $model app\models\Appuntamento */

use bootui\datetimepicker\Datepicker;
use bootui\datetimepicker\Timepicker;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Fissa appuntamento';
?>
<div>
    <div class="bg-white jumbotron">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><b>Inserisci l'ID del bambino con cui prenotare l'appuntamento.</b></p>

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

        <?= $form->field($model, 'id_bambino')->textInput() ?>

        <table class="table table-bordered table-condensed table-striped table-hover">
            <caption>Contatti</caption>
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
            </tr>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < $numero; $i++) {
                echo "<tr>";
                echo "<td>";
                echo $bambini[$i]['id'];
                echo "</td>";
                echo "<td>";
                echo $bambini[$i]['nome'];
                echo "</td>";
                echo "<td>";
                echo $bambini[$i]['cognome'];
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

        <p><b>Inserisci la data e l'ora dell'appuntamento</b></p>

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