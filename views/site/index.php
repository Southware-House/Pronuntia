<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use app\controllers\SiteController;

if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isLogopedista()){
    return Yii::$app->response->redirect(Url::to(['logopedista/home-logopedista', []]));
} else if(!Yii::$app->user->isGuest && !Yii::$app->user->identity->isLogopedista())
    return Yii::$app->response->redirect(Url::to(['bambino/home-bambino', []]));


$this->title = 'Home';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-white">
        <h1 class="display-4">Benvenuto sul sito ufficiale Pronuntia!</h1>

        <p class="lead">Sei un logopedista o un paziente? Effettua l'accesso o registrati dall'apposita sezione in alto!</p>
        <p>Se ne hai la necessità, puoi effettuare un pre-test per avere una pre-diagnosi cliccando sul pulsante seguente!</p>
        <p><a class="btn btn-lg btn-success" href="https://trainingcognitivo.it/PDF/Scriviamo%20le%20doppie.pdf" target=”_blank”>PRE-TEST</a></p>
    </div>

</div>