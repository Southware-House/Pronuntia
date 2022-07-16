<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Appuntamento */
/* @var $form ActiveForm */

$this->title = 'Visualizza appuntamenti';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-appuntamenti-logopedista">

    <div class="jumbotron bg-white">

        <table class="table table-bordered table-condensed table-striped table-hover">
            <caption></caption>
            <thead>
            <tr>
                <th scope="col">Nome bambino</th>
                <th scope="col">Cognome bambino</th>
                <th scope="col">Data appuntamento</th>
                <th scope="col">Orario appuntamento</th>
                <th scope="col">Note</th>
                <th scope="col">Fissato dal caregiver</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i = 0; $i < $numero; $i++) {
                echo "<tr>";
                echo "<td>";
                echo $appuntamenti[$i]['nome'];
                echo "</td>";
                echo "<td>";
                echo $appuntamenti[$i]['cognome'];
                echo "</td>";
                echo "<td>";
                echo $appuntamenti[$i]['data_appuntamento'];
                echo "</td>";
                echo "<td>";
                echo $appuntamenti[$i]['orario_appuntamento'];
                echo "</td>";
                echo "<td>";
                echo $appuntamenti[$i]['note'];
                echo "</td>";
                echo "<td>";
                if($appuntamenti[$i]['isLogopedista'] == 1) {
                    echo "No";
                }
                else {
                    echo "Si";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>