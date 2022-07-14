<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\Appuntamento;

/* @var $this yii\web\View */
/* @var $model app\models\Appuntamento */
/* @var $form ActiveForm */
$this->title = 'Visualizza appuntamenti';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-appuntamenti">

    <div class="jumbotron bg-white">

        <table class="table table-bordered table-condensed table-striped table-hover">
            <caption></caption>
            <thead>
            <tr>
                <th scope="col">Logopedista</th>
                <th scope="col">Data appuntamento</th>
                <th scope="col">Orario appuntamento</th>
                <th scope="col">Note</th>
                <th scope="col">Fissato dal logopedista</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $appuntamenti =  Appuntamento::find()->select('appuntamento.*, logopedista.nome')->innerJoinWith('logopedista', 'appuntamento.id_logopedista = logopedista.id')->where(['id_bambino' => explode('-', Yii::$app->user->identity->getId())[1]])->all();
                foreach ($appuntamenti as $appuntamento) {
                    echo "<tr>";
                        echo "<td>";
                            echo $appuntamento->getRelation('logopedista')->one()->getAttribute('nome') . ' ' . $appuntamento->getRelation('logopedista')->one()->getAttribute('cognome');
                        echo "</td>";
                        echo "<td>";
                            echo $appuntamento->getAttribute('data_appuntamento');
                        echo "</td>";
                        echo "<td>";
                            echo $appuntamento->getAttribute('orario_appuntamento');
                        echo "</td>";
                        echo "<td>";
                    echo $appuntamento->getAttribute('note');
                        echo "</td>";
                    echo "<td>";
                    if($appuntamento->isLogopedista == 1) {
                        echo "Si";
                    }
                    else {
                        echo "No";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>