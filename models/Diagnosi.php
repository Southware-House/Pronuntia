<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diagnosi".
 *
 * @property int $id
 * @property int|null $id_bambino
 * @property int|null $id_logopedista
 * @property string $contenuto_diagnosi
 *
 * @property Bambino $bambino
 * @property Logopedista $logopedista
 */
class Diagnosi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnosi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_bambino', 'id_logopedista'], 'integer'],
            [['contenuto_diagnosi'], 'required'],
            [['contenuto_diagnosi'], 'string', 'max' => 1024],
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
            'id_bambino' => 'Id Bambino',
            'id_logopedista' => 'Id Logopedista',
            'contenuto_diagnosi' => 'Contenuto Diagnosi',
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
