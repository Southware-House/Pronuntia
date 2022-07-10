<?php

namespace app\controllers;

use app\models\ListaEsercizi;
use app\models\Assegnazione;
use app\models\Valutazione;
use Yii;
use yii\db\Connection;
use yii\web\Controller;
use app\models\Esercizio;
use yii\web\UploadedFile;

class EsercizioController extends Controller
{
    public $session;

    public function actionCreaEsercizio() {

        $model = new Esercizio();

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstances($model, 'imageFiles');
            $audio = UploadedFile::getInstances($model, 'audioFiles');
            $imagesPaths = '';
            $audioPaths = '';
            if(!file_exists(ROOTPATH . '/images/esercizi/'.Yii::$app->user->identity->getEmail())){
                mkdir( ROOTPATH . '/images/esercizi/'.Yii::$app->user->identity->getEmail(), 0777, true);
            }
            if(!file_exists(ROOTPATH . '/audio/esercizi/'.Yii::$app->user->identity->getEmail())){
                mkdir( ROOTPATH . '/audio/esercizi/'.Yii::$app->user->identity->getEmail(), 0777, true);
            }

            foreach ($image as $image) {
                $path = ROOTPATH . '/images/esercizi/' . Yii::$app->user->identity->getEmail() . '/' .hash('md5', $image->baseName, false) . '.' . $image->extension;
                $imagesPaths = $imagesPaths . '??' . $path;
                $image->saveAs($path);
            }
            foreach ($audio as $audio) {
                $path = ROOTPATH . '/audio/esercizi/' . Yii::$app->user->identity->getEmail() . '/' .hash('md5', $audio->baseName, false) . '.' . $audio->extension;
                $audioPaths = $audioPaths . '??' . $path;
                $audio->saveAs($path);
            }
            $model->immagini = $imagesPaths;
            $model->files_audio = $audioPaths;
            $id = explode("-", Yii::$app->user->identity->getId());
            $model->id_logopedista = $id[1];
            $model->save();
            return $this->redirect(['/logopedista/home-logopedista']);
        }

        return $this->render('crea-esercizio', array('model'=>$model));
    }

    public function actionCreaListaEsercizi() {

        $model = new ListaEsercizi();
        $id = explode("-", Yii::$app->user->identity->getId());

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("SELECT * FROM Esercizio WHERE id_logopedista like '$id[1]'")->queryColumn();
        $numeroEsercizi = count($command);
        $command2 = $connection->createCommand("SELECT * FROM Esercizio WHERE id_logopedista like '$id[1]'")->queryAll();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_logopedista = $id[1];
            $model->save();
            $listaEsercizi = explode(",", $model->getlista_id());
            $idLista = $model->getId();
            $numeroId = count($listaEsercizi);
            for($i = 0; $i < $numeroId; $i++) {
                if(!in_array($listaEsercizi[$i],$command)) {
                    $command5 = $connection->createCommand("DELETE FROM associazione_esercizio WHERE associazione_esercizio.id_lista_esercizi like $idLista");
                    $command5->execute();
                    $command4 = $connection->createCommand("DELETE FROM lista_esercizi WHERE lista_esercizi.id like $idLista");
                    $command4->execute();
                    return $this->render('crea-lista-esercizi', array('model'=>$model, 'numero_esercizi'=>$numeroEsercizi, 'esercizi'=>$command2, 'err' => true)); //errore
                }
                $command3 = $connection->createCommand("INSERT INTO associazione_esercizio (id_lista_esercizi, id_esercizio) VALUES ($idLista, '$listaEsercizi[$i]')");
                $command3->execute();
            }
            return $this->redirect(['/logopedista/home-logopedista']);
        }

        return $this->render('crea-lista-esercizi', array('model'=>$model, 'numero_esercizi'=>$numeroEsercizi, 'esercizi'=>$command2));

    }

    public function actionAssegnazioneListaEsercizi() {

        $model = new Assegnazione();
        $id = explode("-", Yii::$app->user->identity->getId());

        $query = (new \yii\db\Query())->select('*')->from('lista_esercizi')->where(['id_logopedista'=>$id[1]])->all();
        $numeroListe = count($query);

        $query2 = (new \yii\db\Query())->select(['bambino.id', 'bambino.nome', 'bambino.cognome', 'bambino.email'])->from(['bambino', 'associazione', 'logopedista'])->where("bambino.id like associazione.id_bambino and associazione.email_logo like logopedista.email and logopedista.id like '$id[1]'")->all();
        $numeroBambini = count($query2);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $query3 = (new \yii\db\Query())->select('lista_id')->from('lista_esercizi')->where(['id'=>$model->id_lista])->all();
                $lista_id = explode(",", $query3[0]['lista_id']);
                $numeroEsercizi = count($lista_id);
                $connection = new Connection([
                    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
                    'username' => 'root',
                    'password' => 'root',
                ]);
                $connection->open();
                for ($i = 0; $i < $numeroEsercizi; $i++) {
                    $command = $connection->createCommand("insert into svolgimento_esercizio (id_esercizio, id_bambino) values ('$lista_id[$i]', '$model->id_bambino') ");
                    $command->execute();
                }

                return $this->redirect(['/logopedista/home-logopedista']);
            }
        }

        return $this->render('assegnazione-lista-esercizi', array('model'=>$model, 'numeroListe'=>$numeroListe, 'liste'=>$query, 'numeroBambini'=>$numeroBambini, 'bambini'=>$query2));

    }

    public function actionVisualizzaListeDaSvolgere() {

        $model = new ListaEsercizi();
        $trovato = false;

        $id = explode("-", Yii::$app->user->identity->getId());
        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $command = $connection->createCommand("select lista_esercizi.nome from lista_esercizi, assegnazione where lista_esercizi.id like assegnazione.id_lista and assegnazione.id_bambino like '$id[1]'")->queryColumn();
        $numeroListe = count($command);
        $command2 = $connection->createCommand("select lista_esercizi.id, lista_esercizi.nome from lista_esercizi, assegnazione where lista_esercizi.id like assegnazione.id_lista and assegnazione.id_bambino like '$id[1]'")->queryAll();

        if($model->load(Yii::$app->request->post())) {
            $command3 = $connection->createCommand("select assegnazione.id_lista from assegnazione where assegnazione.id_bambino = $id[1]")->queryColumn();
            $numero = count($command3);
            for($i = 0; $i < $numero; $i++) {
                if($command3[$i] == $model->getId()) {
                    $session = Yii::$app->session;
                    $session->open();
                    $session->set('id_lista', $model->getId());
                    return $this->redirect(['/esercizio/visualizza-esercizi-lista']);
                }
            }

            if($trovato == false) {
                return $this->render('visualizza-liste-da-svolgere', array('liste'=>$command2, 'numeroListe'=>$numeroListe, 'model'=>$model, 'trovato' => $trovato));
            }

        }

        return $this->render('visualizza-liste-da-svolgere', array('liste'=>$command2, 'numeroListe'=>$numeroListe, 'model'=>$model));

    }

    public function actionVisualizzaEserciziLista() {

        $model = new Esercizio();

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $session = Yii::$app->session;
        $id = $session->get('id_lista');
        $id2 = explode("-", Yii::$app->user->identity->getId());

        $connection->open();
        $command = $connection->createCommand("select esercizio.id, esercizio.titolo, esercizio.traccia, svolgimento_esercizio.is_svolto from esercizio, associazione_esercizio, svolgimento_esercizio where esercizio.id = associazione_esercizio.id_esercizio and associazione_esercizio.id_lista_esercizi = '$id' and esercizio.id = svolgimento_esercizio.id_esercizio and svolgimento_esercizio.id_bambino = '$id2[1]'")->queryColumn();
        $numeroEsercizi = count($command);
        $command2 = $connection->createCommand("select esercizio.id, esercizio.titolo, esercizio.traccia, svolgimento_esercizio.is_svolto from esercizio, associazione_esercizio, svolgimento_esercizio where esercizio.id = associazione_esercizio.id_esercizio and associazione_esercizio.id_lista_esercizi = '$id' and esercizio.id = svolgimento_esercizio.id_esercizio and svolgimento_esercizio.id_bambino = '$id2[1]'")->queryAll();

        if($model->load(Yii::$app->request->post())) {
            return $this->redirect(['/esercizio/svolgimento-esercizio', "id"=>$model->getId()]);
        }

        return $this->render('visualizza-esercizi-lista', array('model' => $model, 'esercizi'=>$command2,'numeroEsercizi'=>$numeroEsercizi));
    }

    public function actionSvolgimentoEsercizio($id=null, $setSvolto = null) {

        $nomeImmagini = array();
        $emailLogopedisti = array();
        $nomeAudio = array();
        $emailLogopedistiAudio = array();

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);

        $connection->open();

        if($setSvolto)
        {
            $command = $connection->createCommand("update svolgimento_esercizio set svolgimento_esercizio.is_svolto = true where svolgimento_esercizio.id_esercizio = '$id'");
            $command->execute();
            $this->redirect(['esercizio/visualizza-esercizi-lista']);
        }

        $command = $connection->createCommand("select * from esercizio where esercizio.id = '$id'")->queryOne();

        $unioneDiPathImg = $command['immagini'];
        $divisioneDiPathImg = explode("??", $unioneDiPathImg);
        $numeroImmagini = count($divisioneDiPathImg);
        for ($i = 1; $i < $numeroImmagini; $i++) {
            $splitSingolo = explode("/", $divisioneDiPathImg[$i]);
            $numDir = count($splitSingolo);
            $indice = $numDir - 1;
            $indice2 = $numDir - 2;
            array_push($nomeImmagini, $splitSingolo[$indice]);
            array_push($emailLogopedisti, $splitSingolo[$indice2]);
        }

        $unioneDiPathAudio = $command['files_audio'];
        $divisioneDiPathAudio = explode("??", $unioneDiPathAudio);
        $numeroAudio = count($divisioneDiPathAudio);
        for ($i = 1; $i < $numeroAudio; $i++) {
            $splitSingolo = explode("/", $divisioneDiPathAudio[$i]);
            $numDir = count($splitSingolo);
            $indice = $numDir - 1;
            $indice2 = $numDir - 2;
            array_push($nomeAudio, $splitSingolo[$indice]);
            array_push($emailLogopedistiAudio, $splitSingolo[$indice2]);
        }

        return $this->render('svolgimento-esercizio', array('esercizio' => $command, 'numeroImmagini' => $numeroImmagini - 1, 'nomeImmagini' => $nomeImmagini, 'emailLogopedisti' => $emailLogopedisti, 'numeroAudio' => $numeroAudio - 1, 'nomeAudio' => $nomeAudio, 'emailLogopedistiAudio' => $emailLogopedistiAudio));
    }

    public function actionVisualizzaListeDaValutare() {

        $model = new ListaEsercizi();

        $id = explode("-", Yii::$app->user->identity->getId());
        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        //$nomeListaEsercizi = $connection->createCommand("select lista_esercizi.nome from lista_esercizi, assegnazione where lista_esercizi.id = assegnazione.id_lista and assegnazione.id_bambino = '$id[1]'")->queryColumn();
        $listeEsercizi = $connection->createCommand("select lista_esercizi.id, lista_esercizi.nome from lista_esercizi, assegnazione where lista_esercizi.id = assegnazione.id_lista and assegnazione.id_bambino = '$id[1]'")->queryAll();
        $numeroListe = count($listeEsercizi);

        if($model->load(Yii::$app->request->post())) {
            if(ListaEsercizi::findOne(['id' => $model->getId()]) == null)
                return $this->render('visualizza-liste-da-valutare', array('liste'=>$listeEsercizi, 'numeroListe'=>$numeroListe, 'model'=>$model, 'trovato'=>false));
            $session = Yii::$app->session;
            $session->open();
            $session->set('id_lista_da_valutare', $model->getId());
            return $this->redirect(['/esercizio/valuta-lista-esercizi']);
        }

        return $this->render('visualizza-liste-da-valutare', array('liste'=>$listeEsercizi, 'numeroListe'=>$numeroListe, 'model'=>$model));

    }

    public function actionValutaListaEsercizi() {

        $model = new Valutazione();

        $id = explode("-", Yii::$app->user->identity->getId());

        $session = Yii::$app->session;
        $idLista = $session->get('id_lista_da_valutare');

        $connection = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=yii2basic',
            'username' => 'root',
            'password' => 'root',
        ]);
        $connection->open();
        $nomeListaEsercizi = $connection->createCommand("select lista_esercizi.nome from lista_esercizi 
                                                    where lista_esercizi.id = '$idLista'")->queryOne();
        if($model->load(Yii::$app->request->post())) {
            $model->id_lista_esercizi = $idLista;
            $model->id_bambino = $id[1];
            if($model->save()) {
                return $this->redirect(['/esercizio/valutazione-lista-effettuata']);
            }
            else {
                return $this->redirect(['/esercizio/valutazione-lista-non-effettuata']);
            }
        }

        return $this->render('valuta-lista-esercizi', array('model'=>$model, 'nome' => $nomeListaEsercizi['nome']));

    }

    public function actionValutazioneListaEffettuata() {

        return $this->render('valutazione-lista-effettuata');

    }

    public function actionValutazioneListaNonEffettuata() {

        return $this->render('valutazione-lista-non-effettuata');

    }

}