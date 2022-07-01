<?php

namespace app\controllers;

use app\models\ListaEsercizi;
use app\models\SceltaLista;
use Yii;
use app\models\Bambino;
use yii\db\Connection;
use yii\web\Controller;

class BambinoController extends Controller
{
    public function actionRegisterBambino() {
        $model = new Bambino();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $query = (new \yii\db\Query())->select("email")->from('logopedista')->where(['email'=>$model->email]);
                $query2 = (new \yii\db\Query())->select("email")->from('bambino')->where(['email'=>$model->email]);
                $rows = $query->union($query2)->count();
                if($rows != 0){
                    return $this->redirect(array('/bambino/register-bambino', 'check'=>false));
                }
                $model->passwd = password_hash($_POST['Bambino']['passwd'], PASSWORD_DEFAULT);
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

    public function actionVisualizzaListeDaSvolgere() {

        $model = new ListaEsercizi();
        $flag = false;

        $id = explode("-", Yii::$app->user->identity->getId());
        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("select lista_esercizi.nome from lista_esercizi, assegnazione where lista_esercizi.id like assegnazione.id_lista and assegnazione.id_bambino like '$id[1]'")->queryColumn();
        $numeroListe = count($command);

        if($model->load(Yii::$app->request->post())) {
            $flag = true;
            $command2 = $connection->createCommand("select id_esercizio from associazione_esercizio where id_lista_esercizi like '$model->prova()'")->queryColumn();


        }

        return $this->render('visualizza-liste-da-svolgere', array('liste'=>$command, 'numeroListe'=>$numeroListe, 'model'=>$model, 'flag'=>$flag));

    }

    public function actionVisualizzaEserciziLista() {



        return $this->render('visualizza-esercizi-lista');

    }
}