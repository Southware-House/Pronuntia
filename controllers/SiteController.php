<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\db\Connection;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Logopedista;
use app\models\Bambino;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegisterl() {
        $model = new Logopedista();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->email = $_POST['Logopedista']['email'];
                $model->passwd = password_hash($_POST['Logopedista']['passwd'], PASSWORD_DEFAULT);
                $model->nome = $_POST['Logopedista']['nome'];
                $model->cognome = $_POST['Logopedista']['cognome'];
                $model->indirizzo = $_POST['Logopedista']['indirizzo'];
                $model->telefono = $_POST['Logopedista']['telefono'];
                if($model->save()) {
                    $connection = new Connection([
                        'dsn' => 'mysql:host=localhost;dbname=yii2basic',
                        'username' => 'root',
                        'password' => 'root',
                    ]);
                    $connection->open();
                    $command = $connection->createCommand("INSERT INTO Utente (email, passwd, isLogopedista) VALUES ('$model->email', '$model->passwd', True)");
                    $command->execute();
                    return $this->redirect(['login']);
                }
            }
        }

        return $this->render('registerl', [
            'model' => $model,
        ]);
    }

    public function actionSceltar() {

        return $this->render('sceltar');

    }

    public function actionRegisterb() {
        $model = new Bambino();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('registerb', [
            'model' => $model,
        ]);
    }

    public function actionHomel() {

        return $this->render('homel');

    }

    public $id;

    public function actionGeneraCodice() {
        $email=Yii::$app->user->identity->email;
        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("INSERT INTO Associazione (email_logo) VALUES ('$email')");
        $command->execute();
        $command = $connection->createCommand("SELECT max(id_bambino) as id FROM Associazione")->queryScalar();
        //$command->execute();
        return $this->render('genera-codice', array('id'=>$command));

    }
}
