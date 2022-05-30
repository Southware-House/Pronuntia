<?php

/** @var yii\web\View $this */

use app\controllers\SiteController;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;

$this->title = 'Registrazione';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Sei un logopedista o un paziente?</h1>

        </br>

        <?php
        NavBar::begin(['brandLabel' => false]);
        echo Nav::widget([
            'items' => [
                ['label' => 'Registrazione Logopedista', 'url' => ['/site/register-logopedista']],
                ['label' => 'Registrazione Paziente', 'url' => ['/site/register-bambino']],
            ],
            'options' => ['class' => 'navbar-nav'],
        ]);
        NavBar::end();
        ?>

    </div>
</div>