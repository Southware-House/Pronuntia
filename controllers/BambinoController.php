<?php

namespace app\controllers;

use Yii;
use app\models\Bambino;
use yii\web\Controller;

class BambinoController extends Controller
{
    public function actionRegisterBambino() {
        $model = new Bambino();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->id = $_POST['Bambino']['id'];
                $model->età = $_POST['Bambino']['età'];
                $model->email = $_POST['Bambino']['email'];
                $model->passwd = password_hash($_POST['Bambino']['passwd'], PASSWORD_DEFAULT);
                $model->nome = $_POST['Bambino']['nome'];
                $model->cognome = $_POST['Bambino']['cognome'];
                $model->indirizzo = $_POST['Bambino']['indirizzo'];
                $model->telefono = $_POST['Bambino']['telefono'];
                $model->passwd_caregiver = password_hash($_POST['Bambino']['passwd_caregiver'], PASSWORD_DEFAULT);
                if($model->save()) {
                    return $this->redirect(['/site/login']);
                }
            }
        }

        return $this->render('register-bambino', [
            'model' => $model,
        ]);
    }

    public function actionHomeBambino() {

        return $this->render('home-bambino');

    }
}