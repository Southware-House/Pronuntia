<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logopedista".
 *
 * @property string $email
 * @property string|null $passwd
 * @property string|null $nome
 * @property string|null $cognome
 * @property string|null $indirizzo
 * @property string|null $telefono
 *
 * @property Associazione[] $associaziones
 */
class Logopedista extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logopedista';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'email'], //formato valido email
            [['email'], 'string', 'max' => 50],
            [['cognome', 'indirizzo'], 'string', 'max' => 30],
            [['passwd'], 'string', 'max' => 255],
            [['passwd'], 'required'],
            [['nome'], 'string', 'max' => 20],
            [['telefono'], 'string', 'max' => 10],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'passwd' => 'Passwd',
        ];
    }

    /**
     * Gets query for [[Associaziones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssociaziones()
    {
        return $this->hasMany(Associazione::className(), ['email_logo' => 'email']);
    }

    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        return self::findOne(['accessToken' => $token]);
    }

    public static function findByEmail($email){//nuova funzione messa da me
        return self::findOne(['email' => $email]);
    }

    public function getEmail(){//nuova funzione messa da me 
        return $this->email;
    }

    public function getId(){
        //return $this->id;
    }

    public function getAuthKey(){
        //return $this->authKey;
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }

    public function validatePassword($passwd){
        return password_verify($passwd, $this->passwd);
    }
}
