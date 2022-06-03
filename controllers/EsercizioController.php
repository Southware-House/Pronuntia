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

        //$esercizi = Esercizio::find()->where(['id_logopedista' => $id[1]])->all();
        //$esercizi = ArrayHelper::map(Esercizio::find()->where(['id_logopedista' => $id[1]])->all(), 'id', 'titolo');

        if ($model->load(Yii::$app->request->post())) {
            $model->id_logopedista = $id[1];
            $model->save();
            return $this->redirect(['/logopedista/home-logopedista']);
        }

        return $this->render('crea-lista-esercizi', array('model'=>$model, 'numero_esercizi'=>$numeroEsercizi, 'esercizi'=>$command2));

    }

}