<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bambino".
 *
 * @property string $id
 * @property string|null $email
 * @property string|null $passwd
 * @property string|null $nome
 * @property string|null $cognome
 * @property string|null $indirizzo
 * @property string|null $telefono
 * @property int|null $età
 * @property string|null $passwd_caregiver
 *
 * @property Associazione $id0
 */
class Bambino extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bambino';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['età'], 'integer'],
            [['id'], 'string', 'max' => 6],
            [['email'], 'string', 'max' => 50],
            [['passwd'], 'string', 'max' => 20],
            [['nome', 'cognome', 'indirizzo'], 'string', 'max' => 30],
            [['telefono'], 'string', 'max' => 10],
            [['passwd_caregiver'], 'string', 'max' => 5],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Associazione::className(), 'targetAttribute' => ['id' => 'id_bambino']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'passwd' => 'Passwd',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'indirizzo' => 'Indirizzo',
            'telefono' => 'Telefono',
            'età' => 'Età',
            'passwd_caregiver' => 'Passwd Caregiver',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Associazione::className(), ['id_bambino' => 'id']);
    }
}
