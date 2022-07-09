<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "Bambino".
 *
 * @property int|null $id
 * @property string $email
 * @property string $passwd
 * @property string|null $nome
 * @property string|null $cognome
 * @property string|null $indirizzo
 * @property string|null $telefono
 * @property int|null $età
 * @property string|null $passwd_caregiver
 */
class Bambino extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Bambino';
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
            [['email'], 'required'],
            [['passwd'], 'string', 'max' => 255],
            [['passwd'], 'required'],
            [['nome', 'cognome', 'indirizzo'], 'string', 'max' => 30],
            [['telefono'], 'string', 'max' => 10],
            [['passwd_caregiver'], 'string', 'max' => 255],
            [['passwd_caregiver'], 'required'],
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
            'passwd' => 'Password',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'indirizzo' => 'Indirizzo',
            'telefono' => 'Telefono',
            'età' => 'Età',
            'passwd_caregiver' => 'Password Caregiver',
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

    public function getPasswdCaregiver() {
        return $this->passwd_caregiver;
    }
}
