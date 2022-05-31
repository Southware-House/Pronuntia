<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Esercizio;
use app\models\UploadForm;
use yii\web\UploadedFile;

class EsercizioController extends Controller
{
    public function actionCreaEsercizio() {

        $model = new Esercizio();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $esercizio_id = $model->id_esercizio;
            $image = UploadedFile::getInstance($model, 'immagini');
            $imgName = 'esercizio_' . $esercizio_id . '.' . $image->getExtension();
            $image->saveAs(dirname(__FILE__) . '\..\images\esercizi' . '\\' . $imgName);
            $model->traccia = $_POST['Esercizio']['traccia'];
            $model->file_audio = $_POST['Esercizio']['file_audio'];
            $model->immagini = dirname(__FILE__) . '\..\images\esercizi' . '\\' . $imgName;
            $model->save();
            return $this->redirect(['/logopedista/home-logopedista']);
        }
        else {
            return $this->render('crea-esercizio', array('model'=>$model));
        }

    }


}