<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Esercizio".
 *
 * @property int $id_esercizio
 * @property int|null $id_lista_esercizi
 * @property int|null $id_logopedista
 * @property string|null $traccia
 * @property string|null $file_audio
 * @property string|null $immagini
 * @property int|null $is_svolto
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista_esercizi', 'id_logopedista', 'is_svolto'], 'integer'],
            [['traccia', 'file_audio', 'immagini'], 'string', 'max' => 510],
            [['imageFiles'], 'file', 'extensions' => 'png,jpg', 'maxFiles' => 4]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_esercizio' => 'Id Esercizio',
            'id_lista_esercizi' => 'Id Lista Esercizi',
            'id_logopedista' => 'Id Logopedista',
            'traccia' => 'Traccia',
            'file_audio' => 'File Audio',
            'imageFiles' => 'Immagini',
            'is_svolto' => 'Is Svolto',
        ];
    }
}
