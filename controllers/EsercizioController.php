<?php

namespace app\controllers;

use app\models\ListaEsercizi;
use Yii;
use yii\db\Connection;
use yii\web\Controller;
use app\models\Esercizio;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

class EsercizioController extends Controller
{
    public function actionCreaEsercizio() {

        $model = new Esercizio();

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstances($model, 'imageFiles');
            $audio = UploadedFile::getInstances($model, 'audioFiles');
            $imagesPaths = '';
            $audioPaths = '';
            if(!file_exists(getcwd() . '/images/esercizi/'.Yii::$app->user->identity->getEmail())){
                mkdir(getcwd() . '/images/esercizi/'.Yii::$app->user->identity->getEmail(), 0777, true);
            }
            if(!file_exists(getcwd() . '/audio/esercizi/'.Yii::$app->user->identity->getEmail())){
                mkdir(getcwd() . '/audio/esercizi/'.Yii::$app->user->identity->getEmail(), 0777, true);
            }
            foreach ($image as $image) {
                $path = getcwd() . '/images/esercizi/' . Yii::$app->user->identity->getEmail() . '/' .hash('md5', $image->baseName, false) . '.' . $image->extension;
                $imagesPaths = $imagesPaths . '??' . $path;
                $image->saveAs($path);
            }
            foreach ($audio as $audio) {
                $path = getcwd() . '/audio/esercizi/' . Yii::$app->user->identity->getEmail() . '/' .hash('md5', $audio->baseName, false) . '.' . $audio->extension;
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
                    return $this->render('errore-lista-esercizi');
                }
                $command3 = $connection->createCommand("INSERT INTO associazione_esercizio (id_lista_esercizi, id_esercizio) VALUES ($idLista, '$listaEsercizi[$i]')");
                $command3->execute();
            }
            return $this->redirect(['/logopedista/home-logopedista']);
        }

        return $this->render('crea-lista-esercizi', array('model'=>$model, 'numero_esercizi'=>$numeroEsercizi, 'esercizi'=>$command2));

    }

}