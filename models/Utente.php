<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "Utente".
 *
 * @property int|null $id
 * @property string $email
 * @property string $passwd
 * @property int $isLogopedista
 */
class Utente extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Utente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'isLogopedista'], 'integer'],
            [['email', 'passwd', 'isLogopedista'], 'required'],
            [['email'], 'string', 'max' => 50],
            [['passwd'], 'string', 'max' => 255],
            [['email'], 'unique'],
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
            'isLogopedista' => 'Is Logopedista',
        ];
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return self::findOne(['accessToken' => $token]);
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($passwd){
        return password_verify($passwd, $this->passwd);
    }

    public static function findByEmail($email) {
        return self::findOne(['email' => $email]);
    }

    public function getEmail() {
        return $this->email;
    }
}
