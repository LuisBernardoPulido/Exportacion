<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "a02_usudatos".
 *
 * @property integer $a02_id
 * @property integer $a01_id
 * @property string $a02_nombre
 * @property string $a02_apaterno
 * @property string $a02_amaterno
 * @property string $a02_email
 * @property string $a02_telfono
 * @property string $a02_direccion
 * @property integer $a02_activo
 * @property integer $a02_intentos
 * @property integer $a02_islab
 * @property integer $a02_ismed
 * @property integer $c05_id
 * @property integer $a02_usuAlta
 * @property string $a02_fecAlta
 * @property integer $a02_usuMod
 * @property string $a02_fecMod
 *
 * @property Users $Usuario
 */
class PerfilUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'a02_usudatos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a01_id', 'a02_nombre', 'a02_usuAlta'], 'required'],
            [['a01_id', 'a02_activo', 'a02_intentos', 'a02_islab', 'a02_ismed', 'c05_id', 'a02_usuAlta', 'a02_usuMod'], 'integer'],
            [['a02_fecAlta', 'a02_fecMod'], 'safe'],
            [['a02_apaterno', 'a02_amaterno'], 'string', 'max' => 50],
            [['a02_nombre'], 'string', 'max' => 100],
            [['a02_email'], 'string', 'max' => 80],
            [['a02_telfono'], 'string', 'max' => 25],
            [['a02_direccion'], 'string', 'max' => 200],
            [['a01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['a01_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'a02_id' => 'Id',
            'a01_id' => 'Usuario',
            'a02_nombre' => 'Nombre',
            'a02_apaterno' => 'Primer apellido',
            'a02_amaterno' => 'Segundo apellido',
            'a02_email' => 'Email',
            'a02_telfono' => 'Telefono',
            'a02_direccion' => 'Dirección',
            'a02_activo' => 'Estatus',
            'a02_intentos' => 'Intentos erroneos de acceso',
            'a02_islab' => 'Laboratorio ',
            'a02_ismed' => 'Es médico',
            'c05_id' => 'ID Médico',
            'a02_usuAlta' => 'Usuario Alta',
            'a02_fecAlta' => 'Fecha de Alta',
            'a02_usuMod' => 'Usuario Modificación',
            'a02_fecMod' => 'Fecha de Modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Users::className(), ['id' => 'a01_id']);
    }

    /**
     * @param $id
     * @return null|Perfilusuario
     */
    public static function getPerfil($id)
    {
        return Perfilusuario::find()->where('a01_id=:id',[':id'=>$id])->one();
    }
    public static function getUsuariosAll()
    {
        $dropciones = Users::find()
            ->where("activate=:activo ", [':activo' => 1])
            ->asArray()
            ->all();
        return ArrayHelper::map($dropciones, 'id', 'username');

    }

    public static function getAll()
    {
        $dropciones = Users::find()

            ->asArray()
            ->all();
        return ArrayHelper::map($dropciones, 'id', 'username');

    }

    public static function desactivarUsuario($id)
    {
        $model=PerfilUsuario::findOne($id);
        $us = Users::findOne($model->a01_id);
        $us->activate=-1;
        $us->save(false);
        $model->a02_activo=-1;
        $model->save();
    }

    public static function getAllUsuarios() {
        $dropciones = PerfilUsuario::find()
            ->where("a02_activo=:activo ", [':activo' => 1])
            ->orderBy('a02_nombre')
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }

        return ArrayHelper::map($dropciones, 'a02_id', function($model, $defaultValue) {
            return strtoupper($model['a02_nombre']) . ' ' . strtoupper($model['a02_apaterno']). ' ' . strtoupper($model['a02_amaterno']);
        });
    }
}
