<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assegnazione".
 *
 * @property int $id_lista
 * @property int $id_bambino
 *
 * @property Bambino $bambino
 * @property ListaEsercizi $lista
 */
class Assegnazione extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assegnazione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista', 'id_bambino'], 'required'],
            [['id_lista', 'id_bambino'], 'integer'],
            [['id_lista', 'id_bambino'], 'unique', 'targetAttribute' => ['id_lista', 'id_bambino']],
            [['id_lista'], 'exist', 'skipOnError' => true, 'targetClass' => ListaEsercizi::className(), 'targetAttribute' => ['id_lista' => 'id']],
            [['id_bambino'], 'exist', 'skipOnError' => true, 'targetClass' => Bambino::className(), 'targetAttribute' => ['id_bambino' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lista' => 'Id Lista',
            'id_bambino' => 'Id Bambino',
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
     * Gets query for [[Lista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLista()
    {
        return $this->hasOne(ListaEsercizi::className(), ['id' => 'id_lista']);
    }
}
