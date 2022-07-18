<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use app\models\Persona;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
    </style>
</head>
<body class="d-flex flex-column min-vh-100" style="background-image: url('<?php echo Yii::$app->request->getBaseUrl(); ?> /images/background.png'); background-size: 200% 200%;">
<?php $this->beginBody() ?>

<header style="margin-bottom:50px;">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['alt'=>Yii::$app->name, 'width'=>'300px', 'height'=>'75px']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-light navbar-inverse navbar-static-top fixed-top',
            'style' => 'background-color: #e3f2fd'
        ],
    ]);
    $navItem = [];
    if(Yii::$app->user->isGuest) {
        array_push($navItem, ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Login', 'url' => ['/site/login']],
            ['label' => 'Registrazione', 'url' => ['/site/scelta-registrazione']]);
    }else {
        if(Yii::$app->user->identity->isLogopedista()) {
            array_push($navItem, ['label' => 'Home', 'url' => ['/logopedista/home-logopedista']]);
        }
        else {
            array_push($navItem, ['label' => 'Home', 'url' => ['/bambino/home-bambino']]);
        }
        /*array_push($navItem, ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']]);*/
        array_push($navItem, '<li>'. Html::beginForm(['/site/logout'],
                'post', ['class' => 'form-inline']). Html::submitButton('Logout ('. Yii::$app->user->identity->getEmail().')',
                ['class' => 'btn btn-link text-light bg-dark logout']).Html::endForm().'</li>');
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $navItem
    ]);
    NavBar::end();
    ?>
</header>
<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<footer class="footer mt-lg-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; Pronuntia <?= date('Y') ?></p>
        <p class="float-right"> Developed by SouthwareHouse@UNIBA </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
