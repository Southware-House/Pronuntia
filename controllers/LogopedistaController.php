<?php

namespace app\controllers;

use Yii;
use app\models\Logopedista;
use yii\db\Connection;
use yii\web\Controller;

class LogopedistaController extends Controller
{
    public function actionRegisterLogopedista()
    {
        $model = new Logopedista();

        if ($model->load(Yii::$app->request->post())) {
            $query = (new \yii\db\Query())->select("email")->from('logopedista')->where(['email'=>$model->email]);
            $query2 = (new \yii\db\Query())->select("email")->from('bambino')->where(['email'=>$model->email]);
            $rows = $query->union($query2)->count();
            if($rows != 0){
                return $this->redirect(array('/logopedista/register-logopedista', 'check'=>false));
            }
            if ($model->validate()) {
                $model->passwd = password_hash($model->passwd, PASSWORD_DEFAULT);
                if ($model->save()) {
                    return $this->redirect(['/site/login']);
                }
            }
        }
        return $this->render('register-logopedista', [
            'model' => $model,
        ]);
    }

    public function actionGeneraCodice() {
        $email=Yii::$app->user->identity->getEmail();
        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("INSERT INTO Associazione (email_logo) VALUES ('$email')");
        $command->execute();
        $command = $connection->createCommand("SELECT max(id_bambino) as id FROM Associazione")->queryScalar();
        return $this->render('genera-codice', array('id'=>$command));
    }

    public function actionHomeLogopedista() {

        return $this->render('home-logopedista');

    }

}
