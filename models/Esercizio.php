<?php

namespace app\models;

use yii\web\UploadedFile;

/**
 * This is the model class for table "esercizio".
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
     * @param int|null $id_lista_esercizi
     * @param int|null $id_logopedista
     * @param string|null $traccia
     * @param string|null $file_audio
     * @param string|null $immagini
     * @param int|null $is_svolto
     */
    /*public function __construct(?int $id_lista_esercizi, ?int $id_logopedista, ?string $traccia, ?string $file_audio, ?string $immagini, ?int $is_svolto)
    {
        $this->id_lista_esercizi = $id_lista_esercizi;
        $this->id_logopedista = $id_logopedista;
        $this->traccia = $traccia;
        $this->file_audio = $file_audio;
        $this->immagini = $immagini;
        $this->is_svolto = $is_svolto;
    }*/

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'esercizio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista_esercizi', 'id_logopedista', 'is_svolto'], 'integer'],
            [['traccia', 'file_audio', 'immagini'], 'string', 'max' => 510]/*,
            [['immagini'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']*/
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
            'immagini' => 'Immagini',
            'is_svolto' => 'Is Svolto',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
