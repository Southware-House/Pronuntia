<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Esercizio;
use yii\web\UploadedFile;

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
            $model->titolo = $_POST['Esercizio']['titolo'];
            $model->save();
            return $this->redirect(['/logopedista/home-logopedista']);
        }

        return $this->render('crea-esercizio', array('model'=>$model));
    }

    public function actionCreaListaEsercizi() {



        return $this->render('crea-lista-esercizi');

    }

}