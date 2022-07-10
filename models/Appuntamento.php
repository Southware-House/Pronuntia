<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appuntamento".
 *
 * @property int $id
 * @property string $data_appuntamento
 * @property string $orario_appuntamento
 * @property string|null $note
 * @property int $id_bambino
 * @property int $id_logopedista
 *
 * @property Bambino $bambino
 * @property Logopedista $logopedista
 */
class Appuntamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appuntamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_appuntamento', 'orario_appuntamento', 'id_bambino', 'id_logopedista'], 'required'],
            [['data_appuntamento', 'orario_appuntamento'], 'safe'],
            [['id_bambino', 'id_logopedista'], 'integer'],
            [['note'], 'string', 'max' => 200],
            [['id_bambino'], 'exist', 'skipOnError' => true, 'targetClass' => Bambino::className(), 'targetAttribute' => ['id_bambino' => 'id']],
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
            'data_appuntamento' => 'Data Appuntamento',
            'orario_appuntamento' => 'Orario Appuntamento',
            'note' => 'Note',
            'id_bambino' => 'Id Bambino',
            'id_logopedista' => 'Id Logopedista',
        ];
    }

    /**
     * Gets query for [[Bambino]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBambino()
    {
        return $this->hasOne(Bambino::className(), ['id' => 'id_bambino']);
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
}
