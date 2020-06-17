<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c05_mvz".
 *
 * @property integer $c05_id
 * @property string $c05_clave
 * @property string $c05_nombre
 * @property string $c05_apaterno
 * @property string $c05_amaterno
 * @property string $c05_curp
 * @property string $c05_rfc
 * @property string $c05_telefono
 * @property string $c05_colonia
 * @property string $c05_calle
 * @property string $c05_cp
 * @property string $c05_localidad
 * @property string $c05_municipio
 * @property string $c05_estado
 * @property string $c05_correo
 * @property string $c05_tipomvz
 * @property string $c05_identificacion
 * @property string $c05_fexpiracionlicencia
 * @property integer $c05_activo
 * @property string $c05_usuario
 * @property string $c05_contrasena
 * @property integer $user_id
 *
 * @property Users $user
 * @property SeleccionPrevia[] $selecciones
 * @property Brucelosis[] $brucelosis
 * @property Tuberculosis[] $tuberculosis
 * @property Dictamenes[] $dictamenes
 */
class Medicos extends \yii\db\ActiveRecord
{
    public $repeat_password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c05_mvz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_curp','c05_clave','c05_nombre','c05_apaterno','c05_estado','c05_correo','c05_usuario', 'c05_contrasena','repeat_password'], 'required'],
            [['c05_tipomvz'], 'string'],
            [['c05_fexpiracionlicencia'], 'safe'],
            [['c05_activo', 'user_id'], 'integer'],
            [['c05_clave', 'c05_nombre', 'c05_apaterno', 'c05_amaterno', 'c05_curp', 'c05_rfc', 'c05_telefono', 'c05_colonia', 'c05_calle', 'c05_municipio', 'c05_estado', 'c05_correo', 'c05_identificacion', 'c05_usuario', 'c05_contrasena'], 'string', 'max' => 50],
            [['c05_cp','c05_municipio', 'c05_localidad'], 'string', 'max' => 12],
            [['c05_clave'], 'string', 'min' => 14, 'message' => 'Clave Médico debe contener 14 letras.'],
            [['c05_curp'], 'string', 'min' => 18],
            ['c05_correo', 'match', 'pattern' => "/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", 'message' => ''],
            [['c05_contrasena', 'repeat_password'], 'string', 'max' => 80],
            ['repeat_password', 'compare', 'compareAttribute' => 'c05_contrasena', 'message' => 'Las contraseñas no coinciden'],
            ['c05_usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras minúsculas y números'],
            ['c05_usuario', 'match', 'pattern' => "/^.{6,50}$/", 'message' => 'Mínimo 6 y máximo 50 caracteres'],
            ['c05_contrasena', 'match', 'pattern' => "/^.{6,250}$/",
                'message' => 'Mínimo 6 y máximo 250 caracteres'],
            [['c05_usuario'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c05_id' => 'ID Médico',
            'c05_clave' => 'Clave Médico',
            'c05_nombre' => 'Nombre',
            'c05_apaterno' => 'Primer apellido',
            'c05_amaterno' => 'Segundo apellido',
            'c05_curp' => 'CURP',
            'c05_rfc' => 'RFC',
            'c05_telefono' => 'Teléfono',
            'c05_colonia' => 'Colonia',
            'c05_calle' => 'Calle y número',
            'c05_cp' => 'Código Postal',
            'c05_localidad' => 'Localidad',
            'c05_municipio' => 'Municipio',
            'c05_estado' => 'Estado',
            'repeat_password' => 'Repetir contraseña',
            'c05_correo' => 'Correo electrónico',
            'c05_tipomvz' => 'Tipo de MVZ',
            'c05_identificacion' => 'Número de identificación',
            'c05_fexpiracionlicencia' => 'Fecha de expiración de licencia',
            'c05_activo' => 'Estatus',
            'c05_usuario' => 'Usuario',
            'c05_contrasena' => 'Contraseña',
            'user_id' => 'Usuario Relacionado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelecciones()
    {
        return $this->hasMany(SeleccionPrevia::className(), ['c05_id' => 'c05_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrucelosis()
    {
        return $this->hasMany(Brucelosis::className(), ['c05_id' => 'c05_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTuberculosis()
    {
        return $this->hasMany(Tuberculosis::className(), ['c05_id' => 'c05_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDictamenes()
    {
        return $this->hasMany(Dictamenes::className(), ['c05_id' => 'c05_id']);
    }



    public static function getAllMedicos() {
        $dropciones = Medicos::find()
            ->where("c05_activo=:activo ", [':activo' => 1])
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }
        return ArrayHelper::map($dropciones, 'c05_id', function($model, $defaultValue) {
                return strtoupper($model['c05_nombre']) . ' ' . strtoupper($model['c05_apaterno']). ' ' . strtoupper($model['c05_amaterno']);
        });
    }

    public static function getMedicosT() {
        $dropciones = Medicos::find()

            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }
        return ArrayHelper::map($dropciones, 'c05_id', function($model, $defaultValue) {
            return strtoupper($model['c05_nombre']) . ' ' . strtoupper($model['c05_apaterno']). ' ' . strtoupper($model['c05_amaterno']);
        });
    }

    public static function getAllMedicosConClave() {
        $dropciones = Medicos::find()
            ->where("c05_activo=:activo ", [':activo' => 1])
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }
        return ArrayHelper::map($dropciones, 'c05_id', function($model, $defaultValue) {
            return strtoupper($model['c05_nombre']) . ' ' . strtoupper($model['c05_apaterno']). ' ' . strtoupper($model['c05_amaterno']) . ' - ' . $model['c05_clave'];
        });
    }

    public static function getAllMedicosConClaveInclusivo() {
        $dropciones = Medicos::find()
            //->where("c05_activo=:activo ", [':activo' => 1])
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }
        return ArrayHelper::map($dropciones, 'c05_id', function($model, $defaultValue) {
            return strtoupper($model['c05_nombre']) . ' ' . strtoupper($model['c05_apaterno']). ' ' . strtoupper($model['c05_amaterno']) . ' - ' . $model['c05_clave'];
        });
    }

    public static function getAllMedicosOrdenados() {
        $dropciones = Medicos::find()
            ->where("c05_activo=:activo ", [':activo' => 1])
            ->orderBy('c05_nombre')
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }

        return ArrayHelper::map($dropciones, 'c05_id', function($model, $defaultValue) {
            return strtoupper($model['c05_nombre']) . ' ' . strtoupper($model['c05_apaterno']). ' ' . strtoupper($model['c05_amaterno']);
        });
    }
    public static  function getMedicosPorTipo($id){
        $dropciones = Medicos::find()->where('c05_tipomvz=:id', ['id'=>$id])->andWhere('c05_activo=:activo', ['activo'=>1])->all();
        return ArrayHelper::map($dropciones, 'c05_id', 'c05_activo');
    }
    public static function checarValidez($id){
       $query = Yii::$app->getDb()->createCommand("UPDATE c05_mvz SET c05_activo = IF(YEAR(c05_fexpiracionlicencia) >= YEAR(CURDATE()),IF((YEAR(c05_fexpiracionlicencia) > YEAR(CURDATE())) || (YEAR(c05_fexpiracionlicencia) = YEAR(CURDATE()) && MONTH(c05_fexpiracionlicencia) >= MONTH(CURDATE())),1,0),0) WHERE c05_id=".$id)->execute();
    }

    public static function asignarFechaVigencia($id){
        $query = Yii::$app->getDb()->createCommand('UPDATE c05_mvz SET c05_fexpiracionlicencia=CONCAT("20", (SUBSTRING(c05_clave, 3, 2)+2), "-", SUBSTRING(c05_clave, 1, 2), "-00") WHERE c05_id='.$id)->execute();

    }

    public static function getAllMedicosSupervisores() {
        $dropciones = Medicos::find()
            ->where("c05_tipomvz='2'")
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }
        return ArrayHelper::map($dropciones, 'user_id', function($model, $defaultValue) {
            return strtoupper($model['c05_nombre']) . ' ' . strtoupper($model['c05_apaterno']). ' ' . strtoupper($model['c05_amaterno']);
        });
    }

    public static function getAllMedicosCoordinadores() {
        $dropciones = Medicos::find()
            ->where("c05_tipomvz='3'")
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }
        return ArrayHelper::map($dropciones, 'user_id', function($model, $defaultValue) {
            return strtoupper($model['c05_nombre']) . ' ' . strtoupper($model['c05_apaterno']). ' ' . strtoupper($model['c05_amaterno']);
        });
    }



}
