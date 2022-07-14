<?php

namespace app\controllers;

use app\models\Appuntamento;
use app\models\Bambino;
use app\models\Associazione;
use app\models\Diagnosi;
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

        $email = Yii::$app->user->identity->getEmail();
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

    public function actionVisualizzaContattiBambini() {

        $email = Yii::$app->user->identity->getEmail();

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("select bambino.id, bambino.email, bambino.nome, bambino.cognome, bambino.telefono
                                                   from bambino, associazione
                                                   where bambino.id = associazione.id_bambino and associazione.email_logo like '$email'")->queryColumn();
        $numero = count($command);
        $command2 = $connection->createCommand("select bambino.id, bambino.email, bambino.nome, bambino.cognome, bambino.telefono
                                                   from bambino, associazione
                                                   where bambino.id = associazione.id_bambino and associazione.email_logo like '$email'")->queryAll();

        return $this->render('visualizza-contatti-bambini', array("contatti" => $command2, "numero" => $numero));

    }

    public function actionFissaAppuntamento() {

        $email = Yii::$app->user->identity->getEmail();
        $id = explode("-", Yii::$app->user->identity->getId());

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("select bambino.id, bambino.nome, bambino.cognome
                                                   from bambino, associazione
                                                   where bambino.id = associazione.id_bambino and associazione.email_logo like '$email'")->queryColumn();
        $numero = count($command);
        $command2 = $connection->createCommand("select bambino.id, bambino.nome, bambino.cognome
                                                   from bambino, associazione
                                                   where bambino.id = associazione.id_bambino and associazione.email_logo like '$email'")->queryAll();

        Yii::$app->session->removeAllFlashes();
        $model = new Appuntamento();
        $model->clearErrors();
        if ($model->load(Yii::$app->request->post())) {
            $model->id_logopedista = intval($id[1]);
            $model->id_bambino = intval($model->id_bambino);
            $model->isLogopedista = 1;
            if ($model->validate()) {
                if ($model->save()) {
                    return $this->redirect(['logopedista/home-logopedista']);
                }
            }
        }

        return $this->render("fissa-appuntamento", array('model' => $model, "bambini" => $command2, "numero" => $numero));

    }

    public function actionVisualizzaAppuntamentiCaregiver() {

        $id = explode("-", Yii::$app->user->identity->getId());

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("select bambino.nome, bambino.cognome, appuntamento.data_appuntamento, appuntamento.orario_appuntamento, appuntamento.note, appuntamento.isLogopedista
                                                   from bambino, appuntamento
                                                   where bambino.id = appuntamento.id_bambino and appuntamento.id_logopedista = '$id[1]'")->queryColumn();
        $numero = count($command);
        $command2 = $connection->createCommand("select bambino.nome, bambino.cognome, appuntamento.data_appuntamento, appuntamento.orario_appuntamento, appuntamento.note, appuntamento.isLogopedista
                                                    from bambino, appuntamento
                                                    where bambino.id = appuntamento.id_bambino and appuntamento.id_logopedista = '$id[1]'")->queryAll();

        return $this->render("visualizza-appuntamenti-caregiver", array("appuntamenti" => $command2, "numero" => $numero));

    }

    public function actionAggiungiDiagnosi() {

        $model = new Diagnosi();

        return $this->render("aggiungi-diagnosi", array('model' => $model));

    }
}