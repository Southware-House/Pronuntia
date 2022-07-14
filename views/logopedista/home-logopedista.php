<?php


/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Home';
?>
<div class="logopedista-home-logopedista">

    <div class="text-center bg-white">
        <br>
        <h1 class="display-4"><b>HOME</b></h1>
        <br>
    </div>

    <br>

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

    <br>

    <div class="row">
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">VISUALIZZA CONTATTI BAMBINI</h5>
                    <p class="card-text">Visualizza la lista dei bambini e dei rispettivi contatti.</p>
                    <?= Html::beginForm(['/logopedista/visualizza-contatti-bambini'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">FISSA APPUNTAMENTO</h5>
                    <p class="card-text">Fissa un appuntamento con un bambino e il suo caregiver.</p>
                    <?= Html::beginForm(['/logopedista/fissa-appuntamento'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('FISSA', ['class' => 'submit']) ?>
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
                    <h5 class="card-title">VISUALIZZA APPUNTAMENTI</h5>
                    <p class="card-text">Visualizza la lista degli appuntamenti con tutti i bambini.</p>
                    <?= Html::beginForm(['/logopedista/visualizza-appuntamenti-caregiver'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('VISUALIZZA', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">AGGIUNGI DIAGNOSI</h5>
                    <p class="card-text">Aggiungi diagnosi di un bambino.</p>
                    <?= Html::beginForm(['/logopedista/visualizza-appuntamenti-caregiver'], 'post', ['enctype' => 'multipart/form-data']) ?>
                    <?= Html::submitButton('AGGIUNGI', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>
</div>