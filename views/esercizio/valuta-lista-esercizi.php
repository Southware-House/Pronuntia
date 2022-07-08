<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Esercizio */
/* @var $form ActiveForm */
$this->title = 'Valuta lista esercizi';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="esercizio-valuta-lista-esercizi">

    <div class="jumbotron bg-white">

    <h4>Valuta la lista con una valutazione da 1 a 5.</h4>

    <?= '<h5>' . "Nome Lista: " . $nome . '</h5>' ?>

    <?php

        $form = ActiveForm::begin([]);
        echo '<div>';
        echo $form->field($model, 'voto')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'])-> label(false);
        echo '</div>';

        echo '<div class="form-group">';
        echo Html::submitButton('Valuta', ['class' => 'btn btn-primary']);
        echo '</div>';
        $form->end();

    ?>
    </div>
</div>