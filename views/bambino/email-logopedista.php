<?php

/** @var yii\web\View $this */

use app\controllers\SiteController;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Email logopedista';
?>
<div class="email-logopedista">

    <br>
    <b style = 'color:red' ><h5>Per contattare il logopedista inviare un'e-mail al seguente indirizzo di posta elettronica:</h5></b>
    <br>
    <?= '<h5>' . $email . '</h5>' ?>
    <br>
    <b style = 'color:red' ><h5>Oppure chiamare al seguente numero:</h5></b>
    <br>
    <?= '<h5>' . $telefono . '</h5>' ?>

</div>