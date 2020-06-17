<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Users extends ActiveRecord {

    public $profile;
    public $password_repeat;

    public static function getDb() {
        return Yii::$app->db;
    }

    public static function tableName() {
        return 'users';
    }

    public function rules()
    {
        return [
            ['username', 'string', 'max' => 50],
            ['username', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras minúsculas y números'],
            [['password', 'password_repeat', 'email', 'username'], 'required'],
            [['authKey','accessToken', 'activate', 'verification_code', 'role'], 'safe'],
            ['email', 'email'],
            ['email', 'string', 'max' => 80],
            ['password', 'match', 'pattern' => "/^.{6,250}$/", 'message' => 'Mínimo 6 y máximo 250 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contraseñas no coinciden'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Usuario',
            'email' => 'Email',
            'password' => 'Contraseña',
            'password_repeat' => 'Repetir contraseña',
        ];
    }

    public static function findIdentity($id) {
        $user = Users::find()
            ->where("activate=:activate", [":activate" => 1])
            ->andWhere("id=:id", ["id" => $id])
            ->one();
        return isset($user) ? new static($user) : null;
    }
    public static function findIdentityUser($id) {
        $user = Users::find()
            ->where("id=:id", ["id" => $id])
            ->one();
        return isset($user) ? new static($user) : null;
    }
    public static function getAllLaboratorios() {
        $dropciones = PerfilUsuario::find()->where('a02_islab=:lab AND a02_activo=1', [':lab'=>1])
            ->all();
        return ArrayHelper::map($dropciones, 'a01_id', function($model, $defaultValue) {
                return strtoupper($model['a02_nombre']) . ' ' . strtoupper($model['a02_apaterno']). ' ' . strtoupper($model['a02_amaterno']);
        });
    }
    public static function getAllNacionales() {
        $dropciones = Users::find()
            ->where("activate=1")
            ->andWhere("role=4")
            ->all();
        return ArrayHelper::map($dropciones, 'id', function($model, $defaultValue) {
            $usuario = PerfilUsuario::find()
                ->where('a02_id=:id', [':id'=>$model->id])
                ->one();
            return strtoupper($usuario['a02_nombre']);
        });
    }

    public static function getAllEstatales() {
        $dropciones = Users::find()
            ->where("activate=1")
            ->andWhere("role=5")
            ->all();
        return ArrayHelper::map($dropciones, 'id', function($model, $defaultValue) {
            $usuario = PerfilUsuario::find()
                ->where('a02_id=:id', [':id'=>$model->id])
                ->one();
            return strtoupper($usuario['a02_nombre']);
        });
    }

}
