<?php

use yii\db\Connection;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $listaEsercizi app\models\ListaEsercizi */
/* @var $form ActiveForm */
$this->title = 'Visualizza esercizi lista';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="visualizza-esercizi-lista">

    <table class="table table-bordered table-condensed table-striped table-hover">
        <caption></caption>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Traccia</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /*$var = array();
        $query = $listaEsercizi::find()->select('esercizio.id, esercizio.titolo, esercizio.traccia')->join('associazione_esercizio', 'lista_esercizi.id = associazione_esercizio.id_lista_esercizi')->join('esercizio', 'associazione_esercizio.id_esercizio = esercizio.id')->all();
        foreach($query as $var){
            echo
            '<tr>'.
                '<td>'.
                    $var['id'];
                '</td>'.
                '<td>'.
                    $var['titolo'];
                '</td>'.
                '<td>'.
                    $var['traccia'];
                '</td>'.
            '</tr>';
        }*/
        ?>
        <?php
        for ($i = 0; $i < $numeroEsercizi; $i++) {
            echo "<tr>";
            echo "<td>";
            echo $esercizi[$i]['id'];
            echo "</td>";
            echo "<td>";
            echo $esercizi[$i]['titolo'];
            echo "</td>";
            echo "<td>";
            echo $esercizi[$i]['traccia'];
            echo "</td>";
            echo "</tr>";
        }
        ?>

        </tbody>
    </table>

</div>