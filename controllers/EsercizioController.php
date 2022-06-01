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
            $paths = '';
            if(!file_exists(getcwd() . '/images/esercizi/'.Yii::$app->user->identity->getEmail())){
                mkdir(getcwd() . '/images/esercizi/'.Yii::$app->user->identity->getEmail(), 0777, true);
            }
            foreach ($image as $image){
                $path =getcwd() . '/images/esercizi/' . Yii::$app->user->identity->getEmail() . '/' .hash('md5', $image->baseName, false) . '.' . $image->extension;
                $paths = $paths . '??' . $path;
                $image->saveAs($path);
            }
            $model->immagini = $paths;
            $id = explode("-", Yii::$app->user->identity->getId());
            $model->id_logopedista = $id[1];
            $model->save();
            return $this->redirect(['/logopedista/home-logopedista']);
        }

        return $this->render('crea-esercizio', array('model'=>$model));
    }


}