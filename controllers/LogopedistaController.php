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

        return $this->render('home-logopedista', ['model' => new Logopedista()]);

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

        $model = new Appuntamento();
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

    public function actionVisualizzaAppuntamentiLogopedista() {

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

        return $this->render("visualizza-appuntamenti-logopedista", array("appuntamenti" => $command2, "numero" => $numero));

    }

    public function actionAggiungiDiagnosi() {

        $model = new Diagnosi();
        $id = explode("-", Yii::$app->user->identity->getId());
        $email = Yii::$app->user->identity->getEmail();
        $sentinella = false;
        $sentinella_stampa = false;

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("select bambino.id, bambino.nome, bambino.cognome
                                                   from bambino, associazione
                                                   where bambino.id = associazione.id_bambino and associazione.email_logo = '$email' and bambino.id not in (select diagnosi.id_bambino from diagnosi)")->queryColumn();
        $numero = count($command);
        $command2 = $connection->createCommand("select bambino.id, bambino.nome, bambino.cognome
                                                    from bambino, associazione
                                                    where bambino.id = associazione.id_bambino and associazione.email_logo = '$email' and bambino.id not in (select diagnosi.id_bambino from diagnosi)")->queryAll();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_logopedista = $id[1];
            for($i = 0; $i < $numero; $i++) {
                if($command[$i] == $model->id_bambino) {
                    $sentinella = true;
                }
            }
            if($sentinella == true) {
                if ($model->validate()) {
                    if ($model->save()) {
                        return $this->redirect(['logopedista/home-logopedista']);
                    }
                }
            }
            else {
                $sentinella_stampa = true;
            }
        }

        return $this->render("aggiungi-diagnosi", array('model' => $model, "bambini" => $command2, "numero" => $numero, "sentinella" => $sentinella_stampa));

    }

    public function actionVisualizzaDiagnosi() {

        $id = explode("-", Yii::$app->user->identity->getId());
        $model = new Diagnosi();
        $sentinella = false;
        $sentinella_stampa = false;

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("select diagnosi.id_bambino, bambino.nome, bambino.cognome, diagnosi.contenuto_diagnosi
                                                   from diagnosi, bambino
                                                   where bambino.id = diagnosi.id_bambino and diagnosi.id_logopedista = '$id[1]'")->queryColumn();
        $numero = count($command);
        $command2 = $connection->createCommand("select diagnosi.id_bambino, bambino.nome, bambino.cognome, diagnosi.contenuto_diagnosi
                                                   from diagnosi, bambino
                                                   where bambino.id = diagnosi.id_bambino and diagnosi.id_logopedista = '$id[1]'")->queryAll();

        if ($model->load(Yii::$app->request->post())) {
            for($i = 0; $i < $numero; $i++) {
                if($command[$i] == $model->id_bambino) {
                    $sentinella = true;
                }
            }
            if($sentinella == true) {
                $command3 = $connection->createCommand("update diagnosi set diagnosi.contenuto_diagnosi = '$model->contenuto_diagnosi' where diagnosi.id_bambino = '$model->id_bambino'");
                $command3->execute();
                return $this->redirect(['logopedista/home-logopedista']);
            }
            else {
                $sentinella_stampa = true;
            }
        }

        return $this->render("visualizza-diagnosi", array("model" => $model, "bambini" => $command2, "numero" => $numero, "sentinella" => $sentinella_stampa));

    }

    public function actionVisualizzaTerapie() {

        $email = Yii::$app->user->identity->getEmail();

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();

        $command = $connection->createCommand("select bambino.nome, bambino.cognome, andamento_terapia.esercizi_svolti, andamento_terapia.esercizi_totali
                                                   from associazione, bambino, andamento_terapia
                                                   where associazione.id_bambino = bambino.id and associazione.email_logo like '$email' and bambino.id = andamento_terapia.id_bambino")->queryColumn();
        $numero = count($command);
        $command2 = $connection->createCommand("select bambino.nome, bambino.cognome, andamento_terapia.esercizi_svolti, andamento_terapia.esercizi_totali
                                                   from associazione, bambino, andamento_terapia
                                                   where associazione.id_bambino = bambino.id and associazione.email_logo like '$email' and bambino.id = andamento_terapia.id_bambino")->queryAll();

        return $this->render("visualizza-terapie", array("bambini" => $command2, "numero" => $numero));

    }

    public function actionVisualizzaValutazione() {

        $id = explode("-", Yii::$app->user->identity->getId());

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();

        $command = $connection->createCommand("select valutazione.id_lista_esercizi, lista_esercizi.nome, round(avg(valutazione.voto), 2) as voto
                                                   from valutazione, lista_esercizi
                                                   where valutazione.id_lista_esercizi = lista_esercizi.id and id_logopedista = '$id[1]'
                                                   group by id_lista_esercizi")->queryColumn();
        $numero = count($command);
        $command2 = $connection->createCommand("select valutazione.id_lista_esercizi, lista_esercizi.nome, round(avg(valutazione.voto), 2) as voto
                                                    from valutazione, lista_esercizi
                                                    where valutazione.id_lista_esercizi = lista_esercizi.id and id_logopedista = '$id[1]'
                                                    group by id_lista_esercizi")->queryAll();

        return $this->render("visualizza-valutazione", array("liste" => $command2, "numero" => $numero));

    }

}