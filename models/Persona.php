<?php

namespace app\models;

use Yii;

final class Persona implements \yii\web\IdentityInterface
{
    const TYPE_CUSTOMER = 'logopedista';
    const TYPE_SUPPLIER = 'bambino';

    const ALLOWED_TYPES = [self::TYPE_CUSTOMER, self::TYPE_SUPPLIER];

    private $_id;
    private $_authkey;
    private $_passwordHash;
    private $_email;
    private $_isLogopedista = false;

    public static function findIdentity($id)
    {
        $parts = explode('-', $id);
        if (\count($parts) !== 2) {
            throw new InvalidCallException('id should be in form of Type-number');
        }
        [$type, $number] = $parts;

        if (!\in_array($type, self::ALLOWED_TYPES, true)) {
            throw new InvalidCallException('Unsupported identity type');
        }

        $model = null;
        $isLogopedista = false;
        switch ($type) {
            case self::TYPE_CUSTOMER:
                $model = Logopedista::find()->where(['id' => $number])->one();
                $isLogopedista = true;
                break;
            case self::TYPE_SUPPLIER:
                $model = Bambino::find()->where(['id' => $number])->one();
                break;
        }

        if ($model === null) {
            return false;
        }


        $identity = new Persona();
        $identity->_id = $id;
        $identity->_authkey = $model->authkey;
        $identity->_passwordHash = $model->passwd;
        $identity->_email = $model->email;
        $identity->_isLogopedista = $isLogopedista;
        return $identity;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $model = Logopedista::find()->where(['token' => $token])->one();
        if (!$model) {
            $model = Bambino::find()->where(['token' => $token])->one();
        }

        if (!$model) {
            return false;
        }

        if ($model instanceof Logopedista) {
            $type = self::TYPE_CUSTOMER;
        } else {
            $type = self::TYPE_SUPPLIER;
        }

        $identity = new Persona();
        $identity->_id = $type . '-' . $model->id;
        $identity->_authkey = $model->authkey;
        $identity->_passwordHash = $model->passwd;
        return $identity;
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->_passwordHash);
    }

    public static function findByUsername($username)
    {
        $model = Logopedista::find()->where(['username' => $username])->one();
        if (!$model) {
            $model = Bambino::find()->where(['username' => $username])->one();
        }

        if (!$model) {
            return false;
        }

        if ($model instanceof Logopedista) {
            $type = self::TYPE_CUSTOMER;
        } else {
            $type = self::TYPE_SUPPLIER;
        }

        $identity = new Persona();
        $identity->_id = $type . '-' . $model->id;
        $identity->_authkey = $model->authkey;
        $identity->_passwordHash = $model->passwd;
        return $identity;
    }

    public static function findIdentityByEmail($email)
    {
        $model = Logopedista::find()->where(['email' => $email])->one();
        if (!$model) {
            $model = Bambino::find()->where(['email' => $email])->one();
        }

        if (!$model) {
            return false;
        }
        $isLogopedista = false;
        if ($model instanceof Logopedista) {
            $type = self::TYPE_CUSTOMER;
            $isLogopedista = true;
        } else {
            $type = self::TYPE_SUPPLIER;
        }

        $identity = new Persona();
        $identity->_id = $type . '-' . $model->id;
        $identity->_authkey = $model->authkey;
        $identity->_passwordHash = $model->passwd;
        $identity->_email = $model->email;
        $identity->_isLogopedista = $isLogopedista;
        return $identity;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getAuthKey()
    {
        return $this->_authkey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function isLogopedista()
    {
        return $this->_isLogopedista;
    }
}
