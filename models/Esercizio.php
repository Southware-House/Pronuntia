<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Esercizio".
 *
 * @property int $id
 * @property int|null $id_logopedista
 * @property string|null $titolo
 * @property string|null $traccia
 * @property string|null $files_audio
 * @property string|null $immagini
 */
class Esercizio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Esercizio';
    }

    public $imageFiles;
    public $audioFiles;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['id_logopedista'], 'integer'],
            [['traccia', 'files_audio', 'immagini'], 'string', 'max' => 510],
            [['titolo'], 'string', 'max' => 30],
            [['audioFiles'], 'file', 'extensions' => 'mp3,wav,ogg', 'maxFiles' => 4],
            [['imageFiles'], 'file', 'extensions' => 'png,jpg', 'maxFiles' => 4],
            [['id_logopedista'], 'exist', 'skipOnError' => true, 'targetClass' => Logopedista::className(), 'targetAttribute' => ['id_logopedista' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'id_logopedista' => 'Id Logopedista',
            'titolo' => 'Titolo',
            'traccia' => 'Traccia',
            'files_audio' => 'Files Audio',
            'imageFiles' => 'Immagini',
        ];
    }

    public function getId() {

        return $this->id;
    }

    public function getTitolo() {

        return $this->titolo;
    }
}
