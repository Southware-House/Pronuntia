<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "valutazione".
 *
 * @property int $id_lista_esercizi
 * @property int $id_bambino
 * @property int|null $voto
 *
 * @property Bambino $bambino
 * @property ListaEsercizi $listaEsercizi
 */
class Valutazione extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valutazione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista_esercizi', 'id_bambino'], 'required'],
            [['id_lista_esercizi', 'id_bambino', 'voto'], 'integer'],
            [['id_lista_esercizi', 'id_bambino'], 'unique', 'targetAttribute' => ['id_lista_esercizi', 'id_bambino']],
            [['id_lista_esercizi'], 'exist', 'skipOnError' => true, 'targetClass' => ListaEsercizi::className(), 'targetAttribute' => ['id_lista_esercizi' => 'id']],
            [['id_bambino'], 'exist', 'skipOnError' => true, 'targetClass' => Bambino::className(), 'targetAttribute' => ['id_bambino' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lista_esercizi' => 'Id Lista Esercizi',
            'id_bambino' => 'Id Bambino',
            'voto' => 'Voto',
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
     * Gets query for [[ListaEsercizi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListaEsercizi()
    {
        return $this->hasOne(ListaEsercizi::className(), ['id' => 'id_lista_esercizi']);
    }
}
