<?php

namespace app\controllers;

use app\models\Associazione;
use app\models\SceltaLista;
use app\models\Logopedista;
use app\models\Esercizio;
use app\models\ListaEsercizi;
use app\models\Appuntamento;
use Yii;
use app\models\Bambino;
use yii\web\Controller;
use yii\db\Connection;

class BambinoController extends Controller
{
    public function actionRegisterBambino()
    {

        $model = new Bambino();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $query = (new \yii\db\Query())->select("email")->from('logopedista')->where(['email' => $model->email]);
                $query2 = (new \yii\db\Query())->select("email")->from('bambino')->where(['email' => $model->email]);
                $rows = $query->union($query2)->count();
                if ($rows != 0) {
                    return $this->redirect(array('/bambino/register-bambino', 'check' => false));
                }
                $model->passwd = password_hash($_POST['Bambino']['passwd'], PASSWORD_DEFAULT);
                $model->passwd_caregiver = hash('md5', $_POST['Bambino']['passwd_caregiver']);
                if ($model->save()) {
                    return $this->redirect(['/site/login']);
                }
            }
        }

        return $this->render('register-bambino', [
            'model' => $model,
        ]);
    }

    public function actionHomeBambino()
    {

        $model = new Bambino();

        $id = explode("-", Yii::$app->user->identity->getId());

        $risultato = Bambino::find()->where(['id' => $id[1]])->all();


        if ($model->load(Yii::$app->request->post())) {
            if (hash('md5', $model->getPasswdCaregiver()) == $risultato[0]->getPasswdCaregiver()) {
                return $this->redirect(['/bambino/home-caregiver']);
            }
            else {
                return $this->render('home-bambino', array("model" => $model, "errore"=> true));
            }
        }

        return $this->render('home-bambino', array("model" => $model));

    }

    public function actionHomeCaregiver() {

        return $this->render('home-caregiver', array('model' => new Bambino()));

    }

    public function actionVisualizzaEserciziDaConfermare() {

        $esercizi = array();
        $numeroEserciziTot = 0;
        $model = new Esercizio();

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);

        $id = explode("-", Yii::$app->user->identity->getId());

        $connection->open();
        $command = $connection->createCommand("select lista_esercizi.id from assegnazione, lista_esercizi where assegnazione.id_lista = lista_esercizi.id and assegnazione.id_bambino = '$id[1]'")->queryColumn();
        $numeroListe = count($command);
        $command2 = $connection->createCommand("select lista_esercizi.id, lista_esercizi.nome from assegnazione, lista_esercizi where assegnazione.id_lista = lista_esercizi.id and assegnazione.id_bambino = '$id[1]'")->queryAll();

        for ($i = 0; $i < $numeroListe; $i++) {
            $command3 = $connection->createCommand("select esercizio.id, esercizio.titolo, esercizio.traccia, svolgimento_esercizio.is_svolto, svolgimento_esercizio.conferma_caregiver, associazione_esercizio.id_lista_esercizi
                                                        from associazione_esercizio, esercizio, svolgimento_esercizio
                                                        where associazione_esercizio.id_lista_esercizi = '$command[$i]' 
	                                                        and associazione_esercizio.id_esercizio = esercizio.id 
	                                                        and svolgimento_esercizio.id_esercizio = esercizio.id
                                                            and svolgimento_esercizio.id_bambino = '$id[1]'")->queryColumn();
            $numeroEsercizi = count($command3);
            $numeroEserciziTot = $numeroEserciziTot + $numeroEsercizi;
            $command4 = $connection->createCommand("select esercizio.id, esercizio.titolo, esercizio.traccia, svolgimento_esercizio.is_svolto, svolgimento_esercizio.conferma_caregiver, associazione_esercizio.id_lista_esercizi
                                                        from associazione_esercizio, esercizio, svolgimento_esercizio
                                                        where associazione_esercizio.id_lista_esercizi = '$command[$i]' 
	                                                        and associazione_esercizio.id_esercizio = esercizio.id 
	                                                        and svolgimento_esercizio.id_esercizio = esercizio.id
                                                            and svolgimento_esercizio.id_bambino = '$id[1]'")->queryAll();
            for($j = 0; $j < $numeroEsercizi; $j++) {
                array_push($esercizi, $command4[$j]);
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $id2 = $model->getId();
            $command5 = $connection->createCommand("update svolgimento_esercizio set svolgimento_esercizio.conferma_caregiver = true where svolgimento_esercizio.id_esercizio = '$id2' and svolgimento_esercizio.is_svolto like true");
            $command5->execute();
            $command6 = $connection->createCommand("select andamento_terapia.esercizi_svolti from andamento_terapia where andamento_terapia.id_bambino = '$id[1]'")->queryColumn();
            $totale = $command6[0] + 1;
            $command7 = $connection->createCommand("update andamento_terapia set andamento_terapia.esercizi_svolti = '$totale' where andamento_terapia.id_bambino = '$id[1]'");
            $command7->execute();
            return $this->redirect(['visualizza-esercizi-da-confermare']);
        }

        return $this->render('visualizza-esercizi-da-confermare', array("esercizi"=>$esercizi, "liste"=>$command2, "numeroEsercizi" => $numeroEserciziTot, "numeroListe" => $numeroListe, "model" => $model));

    }

    public function actionContattiLogopedista() {

        $model = new ListaEsercizi();

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);

        $id = explode("-", Yii::$app->user->identity->getId());

        $connection->open();
        $command = $connection->createCommand("select associazione.email_logo from associazione where associazione.id_bambino = '$id[1]'")->queryColumn();
        $command2 = $connection->createCommand("select logopedista.telefono from logopedista where logopedista.email like '$command[0]'")->queryColumn();

        if ($model->load(Yii::$app->request->post())) {
            $id = $model->getId();
            return $this->render('contatti-logopedista', array("email" => $command[0], "model" => $model, "variabile" => true, "id" => $id));
        }

        return $this->render('contatti-logopedista', array("email" => $command[0], "model" => $model, 'telefono' => $command2[0]));

    }

    public function actionPrenotaAppuntamento(){

        Yii::$app->session->removeAllFlashes();
        $model = new Appuntamento();
        $model->clearErrors();
        if ($model->load(Yii::$app->request->post())) {
            $model->id_bambino = explode('-', Yii::$app->user->identity->getId())[1];
            $emailLogopedista = Associazione::findOne(["id_bambino" => $model->id_bambino])->email_logo;
            $model->id_logopedista = Logopedista::findByEmail($emailLogopedista)->getId();
            $model->isLogopedista = 0;
            if ($model->validate()) {
                if($model->save()){
                    return $this->redirect(['bambino/home-caregiver']);
                }
            }
        }

        return $this->render("prenota-appuntamento", array('model' => $model));
    }

    public function actionVisualizzaAppuntamentiCaregiver(){

        return $this->render('visualizza-appuntamenti-caregiver', array('model' => new Appuntamento()));
    }

    public function actionVisualizzaTerapia(){

        $id = explode("-", Yii::$app->user->identity->getId());

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);

        $connection->open();
        $command = $connection->createCommand("select andamento_terapia.esercizi_svolti, andamento_terapia.esercizi_totali from andamento_terapia where andamento_terapia.id_bambino = '$id[1]'")->queryOne();

        return $this->render('visualizza-terapia', array('dati' => $command));

    }

}