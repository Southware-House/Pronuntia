<?php


/** @var yii\web\View $this */

use app\controllers\SiteController;
use yii\helpers\Html;

$this->title = 'Home';
?>
<div class="site-homel">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">HOME</h1>

    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CODICE REGISTRAZIONE</h5>
                    <p class="card-text">Genera codice paziente per effettuare la registrazione.</p>
                    <?= Html::beginForm(['/site/genera-codice'], 'post', ['enctype' => 'multipart/form-data']) ?>
                        <?= Html::submitButton('GENERA!', ['class' => 'submit']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>

</div>