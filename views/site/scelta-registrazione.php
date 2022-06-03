<?php

/** @var yii\web\View $this */

use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;

$this->title = 'Registrazione';
?>
<div class="site-scelta-registrazione">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Sei un logopedista o un paziente?</h1>

        </br>

        <?php
        NavBar::begin(['brandLabel' => false]);
        echo Nav::widget([
            'items' => [
                ['label' => 'Registrazione Logopedista', 'url' => ['/logopedista/register-logopedista']],
                ['label' => 'Registrazione Paziente', 'url' => ['/bambino/register-bambino']],
            ],
            'options' => ['class' => 'navbar-nav'],
        ]);
        NavBar::end();
        ?>

    </div>
</div>
