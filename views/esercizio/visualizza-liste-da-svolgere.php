<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ListaEsercizi */
/* @var $form ActiveForm */
$this->title = 'Visualizza liste da svolgere';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-liste-da-svolgere">

    <div class="jumbotron bg-white">

    <table class="table table-bordered table-condensed table-striped table-hover">
        <caption>Liste da svolgere</caption>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
        </tr>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < $numeroListe; $i++) {
            echo "<tr>";
            echo "<td>";
            echo $liste[$i]['id'];
            echo "</td>";
            echo "<td>";
            echo $liste[$i]['nome'];
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    Inserisci l'<u>ID</u> della lista da svolgere
    <br>
    <br>

        <?php

        if(isset($trovato)) {
            echo '<b style = \'color:red\' >' . "ID lista non valido" . '</b>';
        }

        ?>

    <?= $form->field($model, 'id')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton('Svolgi', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    </div>


</div>