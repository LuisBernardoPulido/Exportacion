<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "r01_upp".
 *
 * @property integer $r01_id
 * @property string $r01_nombre
 * @property string $r01_superficie
 * @property string $r01_clave
 * @property string $r01_calle
 * @property string $r01_colonia
 * @property string $r01_cp
 * @property string $r01_localidad
 * @property string $r01_municipio
 * @property string $r01_estado
 * @property string $r01_faretado
 * @property string $r01_tenencia
 * @property string $r01_latitud
 * @property string $r01_longitud
 * @property string $r01_altitud
 * @property integer $r01_tipo
 * @property integer $r01_mostrar
 * @property integer $r01_usuAlta
 * @property string $r01_fecAlta
 * @property integer $r01_usuMod
 * @property string $r01_fecMod
 *
 * @property R03Dictamenes[] $r03Dictamenes
 */
class Upp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r01_upp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r01_nombre', 'r01_clave', 'r01_estado', 'r01_tenencia', 'r01_zona', 'r01_latitud', 'r01_longitud'], 'required'],
            [['r01_tipo', 'r01_mostrar', 'r01_usuAlta', 'r01_usuMod'], 'integer'],
            [['r01_fecAlta', 'r01_fecMod'], 'safe'],
            [['r01_nombre', 'r01_superficie', 'r01_localidad', 'r01_municipio', 'r01_estado', 'r01_faretado', 'r01_tenencia', 'r01_latitud', 'r01_longitud', 'r01_altitud'], 'string', 'max' => 50],
            [['r01_clave'], 'string', 'max' => 15],
            [['r01_latitud'], 'string', 'min' => 6],
            [['r01_longitud'], 'string', 'min' => 8],
            [['r01_calle', 'r01_colonia', 'r01_cp'], 'string', 'max' => 50],
            [['r01_clave'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r01_id' => 'ID UPP',
            'r01_nombre' => 'Nombre de la UPP o PSG',
            'r01_superficie' => 'Superficie',
            'r01_clave' => 'Clave UPP',
            'r01_calle' => 'Calle',
            'r01_colonia' => 'Colonia',
            'r01_cp' => 'CP',
            'r01_localidad' => 'Localidad',
            'r01_municipio' => 'Municipio',
            'r01_estado' => 'Estado',
            'r01_faretado' => 'Fecha de aretado',
            'r01_tenencia' => 'Tenencia',
            'r01_latitud' => 'Latitud',
            'r01_longitud' => 'Longitud',
            'r01_altitud' => 'Altitud',
            'r01_tipo' => 'Tipo',
            'r01_mostrar' => 'Mostrar',
            'r01_usuAlta' => 'Usuario Alta',
            'r01_fecAlta' => 'Fecha Alta',
            'r01_usuMod' => 'Usuario Modificación',
            'r01_fecMod' => 'Fecha Modificación',
            'r01_zona' => 'Zona',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR03Dictamenes()
    {
        return $this->hasMany(R03Dictamenes::className(), ['r01_id' => 'r01_id']);
    }
    public function getUppsMostrar(){
        $aretes = Upp::find()
            ->where('r01_mostrar=:activo',[':activo'=>1]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getUppsFor() {
        //Upp::findBySql()
        $dropciones = Upp::find()->all();
        //$sql = 'select * from r01_upp where r01_id in (select p01_upp from p01_resenas)';

        //$dropciones = Upp::findBySql($sql)->all();
        return ArrayHelper::map($dropciones, 'r01_id', function($model, $defaultValue) {
            return strtoupper($model['r01_clave']).' - '.strtoupper($model['r01_nombre']);
        });
    }
    public static function getUpps() {
        $grupos = Grupos::getUsuarios();
        if($grupos->count()>0){
            $usuario = '(';
            $cont = 0;
            foreach ($grupos->all() as $gr){
                if($cont==1)
                    $usuario .= ' || ';
                $usuario .= 'p01_usuarioCreate='.$gr->a01_id;
                $cont = 1;
            }
            $usuario .= ')';
        }
        else{
            $usuario = 'p01_usuarioCreate='.Yii::$app->user->getId();
        }
        //$sql = 'select * from r01_upp where r01_id in (SELECT p01_upp from p01_resenas WHERE p01_usuarioCreate='.Yii::$app->user->getId().')';
        $sql = 'select * from r01_upp where r01_id in (SELECT p01_upp from p01_resenas WHERE '.$usuario.')';

        $dropciones = Upp::findBySql($sql)->all();
        return ArrayHelper::map($dropciones, 'r01_id', function($model, $defaultValue) {
            return strtoupper($model['r01_clave']).' - '.strtoupper($model['r01_nombre']);
        });
    }
    public static function getUppsOrdenadas() {
        $dropciones = Upp::find()->orderBy('r01_clave')->all();
        return ArrayHelper::map($dropciones, 'r01_id', function($model, $defaultValue) {
            return strtoupper($model['r01_clave']).' - '.strtoupper($model['r01_nombre']);
        });
    }
    public static function getUppsOrdenadasSoloClave() {
        $dropciones = Upp::find()->orderBy('r01_clave')->all();
        return ArrayHelper::map($dropciones, 'r01_id', function($model, $defaultValue) {
            return strtoupper($model['r01_clave']);
        });
    }
    public static function getUppsOrdenadasSoloClaveVacio() {
        $dropciones = Upp::find()->where('r01_id=:cero', [':cero'=>0])->orderBy('r01_clave')->all();
        return ArrayHelper::map($dropciones, 'r01_id', function($model, $defaultValue) {
            return strtoupper($model['r01_clave']);
        });
    }
    public static  function getUppsPorProductor($id){
        $dropciones = PropietarioUnidad::find()->where('c01_id=:id', ['id'=>$id])->all();

        return ArrayHelper::map($dropciones, 'r01_id', 'r01.r01_nombre');
    }
    public static function getUppId($id){
        $upp = Upp::find()->where('r01_id=:id', ['id'=>$id])->one();
        return ArrayHelper::map($upp, 'r01_id', 'r01.r01_nombre');
    }
}
