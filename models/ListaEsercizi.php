<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lista_esercizi".
 *
 * @property int $id
 * @property int|null $id_logopedista
 * @property string $nome
 * @property string $lista_id
 *
 * @property AssociazioneEsercizio[] $associazioneEsercizios
 * @property Esercizio[] $esercizios
 * @property Logopedista $logopedista
 */
class ListaEsercizi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lista_esercizi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_logopedista'], 'integer'],
            [['lista_id', 'nome'], 'required'],
            [['nome', 'lista_id'], 'string', 'max' => 510],
            [['id_logopedista'], 'exist', 'skipOnError' => true, 'targetClass' => Logopedista::className(), 'targetAttribute' => ['id_logopedista' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_logopedista' => 'Id Logopedista',
            'nome' => 'Nome Lista',
            'lista_id' => 'Lista ID esercizi',
        ];
    }

    /**
     * Gets query for [[AssociazioneEsercizios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssociazioneEsercizios()
    {
        return $this->hasMany(AssociazioneEsercizio::className(), ['id_lista_esercizi' => 'id']);
    }

    /**
     * Gets query for [[Esercizios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEsercizios()
    {
        return $this->hasMany(Esercizio::className(), ['id' => 'id_esercizio'])->viaTable('associazione_esercizio', ['id_lista_esercizi' => 'id']);
    }

    /**
     * Gets query for [[Logopedista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLogopedista()
    {
        return $this->hasOne(Logopedista::className(), ['id' => 'id_logopedista']);
    }

    public function getId() {
        return $this->id;
    }

    public function getlista_id() {
        return $this->lista_id;
    }
}
