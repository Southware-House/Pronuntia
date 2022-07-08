<?php


/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Home';
?>
<div class="logopedista-home-logopedista">

    <div class="jumbotron text-center bg-white">
        <h1 class="display-4">HOME LOGOPEDISTA</h1>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">CODICE REGISTRAZIONE</h5>
                    <p class="card-text">Genera codice paziente per effettuare la registrazione.</p>
                    <?= Html::beginForm(['/logopedista/genera-codice'], 'post', ['enctype' => 'multipart/form-data']) ?>
                        <?= Html::submitButton('GENERA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">CREA ESERCIZIO</h5>
                    <p class="card-text">Crea un esercizio da aggiungere ad una lista esercizi.</p>
                    <?= Html::beginForm(['/esercizio/crea-esercizio'], 'post', ['enctype' => 'multipart/form-data']) ?>
                        <?= Html::submitButton('CREA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">CREA LISTA ESERCIZI</h5>
                    <p class="card-text">Crea una lista esercizi da assegnare al bambino.</p>
                    <?= Html::beginForm(['/esercizio/crea-lista-esercizi'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('CREA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">ASSEGNA LISTA ESERCIZI</h5>
                    <p class="card-text">Assegna una lista esercizi da assegnare al bambino.</p>
                    <?= Html::beginForm(['/esercizio/assegnazione-lista-esercizi'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('ASSEGNA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>

    </div>

</div>