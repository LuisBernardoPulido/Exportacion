<?php

namespace app\models;

use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $authKey;
    public $accessToken;
    public $activate;
    public $verification_code;
    public $role;
    const ROLE_SIMPLE =0;
    const ROLE_ADMIN =1;
    const ROLE_LAB =2;
    const ROLE_MEDICO =3;
    const ROLE_NACIONAL = 4;
    const ROLE_ESTATAL = 5;

    public static function isUserAdmin($id){
        if (Users::findOne(['id' => $id, 'activate' => '1', 'role' => self::ROLE_ADMIN]) ||
            Users::findOne(['id' => $id, 'activate' => '1', 'role' => self::ROLE_NACIONAL]) ||
            Users::findOne(['id' => $id, 'activate' => '1', 'role' => self::ROLE_ESTATAL])){
            return true;
        }else{
            return false;
        }

    }

    public static function isCuenta52($id){
        if ($id==52){
            return true;
        }else{
            return false;
        }

    }

    public static function isUserMapa($id){
        if ($id==247){
            return true;
        }else{
            return false;
        }

    }

    public static function isMedicoPermitido($id){
        if ($id==0){
            return true;
        }else{
            return false;
        }

    }

    public static function isUserSimple($id){
        if (Users::findOne(['id' => $id, 'activate' => '1', 'role' => self::ROLE_SIMPLE])){
            return true;
        } else {
            return false;
        }
    }
    public static function isUserLab($id){
        if (Users::findOne(['id' => $id, 'activate' => '1', 'role' => self::ROLE_LAB])){
            return true;
        } else {
            return false;
        }
    }
    public static function isUserMedico($id){
        if (Users::findOne(['id' => $id, 'activate' => '1', 'role' => self::ROLE_MEDICO])){
            return true;
        } else {
            return false;
        }
    }
    public static function isUserSupervisor($id){
        $users = Users::findOne($id);
        if(self::isUserMedico($id) && Medicos::findOne(['c05_usuario' => $users->username, 'c05_tipomvz' => '2']))
            return true;
        else
            false;
    }

    public static function isUserCoordinador($id){
        $users = Users::findOne($id);
        if(self::isUserMedico($id) && Medicos::findOne(['c05_usuario' => $users->username, 'c05_tipomvz' => '3']))
            return true;
        else
            false;
    }

    public static function isUserNacional($id){
        if (Users::findOne(['id' => $id, 'activate' => '1', 'role' => self::ROLE_NACIONAL])){
            return true;
        }else{
            return false;
        }

    }

    public static function isUserEstatal($id){
        if (Users::findOne(['id' => $id, 'activate' => '1', 'role' => self::ROLE_ESTATAL])){
            return true;
        }else{
            return false;
        }

    }

    public static function isUserSuperAdmin($id){
        if (Yii::$app->user->can('/superadmin/*') ){
            return true;
        }else{
            return false;
        }

    }




    public static function findIdentity($id){
        $user =Users::find()
            ->where("activate=:activate", [":activate" => 1])
            ->andWhere("id=:id", ["id" => $id])
            ->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null){
        $users = Users::find()
            ->where("activate=:activate", [":activate" => 1])
            ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
            ->all();
        foreach ($users as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username){
        $users = Users::find()
            ->where("activate=:activate", ["activate" => 1])
            ->andWhere("username=:username", [":username" => $username])
            ->all();
        foreach ($users as $user) {
            if (strcasecmp($user->username, $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey(){
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password){
        /* Valida el password */
        if (Utileria::encrypt($password) == $this->password){
            return $password === $password;
        }
    }
}
