<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "Associazione".
 *
 * @property string $email_logo
 * @property string $id_bambino
*/
class Associazione extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Associazione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email_logo', 'id_bambino'], 'required'],
            [['email_logo'], 'string', 'max' => 50],
            [['id_bambino'], 'string', 'max' => 6],
            [['id_bambino'], 'unique'],
            [['email_logo', 'id_bambino'], 'unique', 'targetAttribute' => ['email_logo', 'id_bambino']],
            [['email_logo'], 'exist', 'skipOnError' => true, 'targetClass' => Logopedista::className(), 'targetAttribute' => ['email_logo' => 'email']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email_logo' => 'Email Logo',
            'id_bambino' => 'Id Bambino',
        ];
    }

    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        // TODO: Implement getId() method.
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
