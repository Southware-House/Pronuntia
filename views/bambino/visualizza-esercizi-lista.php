<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ListaEsercizi */
/* @var $form ActiveForm */
$this->title = 'Visualizza esercizi lista';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-esercizi-lista">

    <table class="table table-bordered table-condensed table-striped table-hover">
        <caption>prova</caption>
        <thead>
        <tr>
            <th scope="col">prova</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
              <?= $model->prova() ?>
            </td>
        </tr>
        </tbody>
    </table>

</div>