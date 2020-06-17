<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c01_ganaderos".
 *
 * @property integer $c01_id
 * @property string $c01_nombre
 * @property string $c01_apaterno
 * @property string $c01_amaterno
 * @property string $c01_curp
 * @property string $c01_rfc
 * @property string $c01_telefono
 * @property string $c01_colonia
 * @property string $c01_calle
 * @property string $c01_cp
 * @property string $c01_localidad
 * @property string $c01_municipio
 * @property string $c01_estado
 * @property string $c01_correo
 * @property integer $c01_tipo
 * @property string $c01_razonsocial
 */
class Ganaderos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c01_ganaderos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c01_nombre', 'c01_apaterno', 'c01_estado'], 'required'],
            [['c01_tipo'], 'integer'],
            [['c01_curp', 'c01_rfc', 'c01_telefono', 'c01_municipio', 'c01_localidad'], 'string', 'max' => 20],
            [['c01_nombre', 'c01_apaterno', 'c01_amaterno'], 'string', 'max' => 80],
            [['c01_colonia', 'c01_calle', 'c01_cp', 'c01_correo'], 'string', 'max' => 50],
            [['c01_razonsocial'], 'string', 'max' => 100],
            [['c01_curp'], 'string', 'min' => 18],
            [['c01_rfc'], 'string', 'min' => 12],
            [['c01_curp', 'c01_rfc'], 'unique'],
            ['c01_correo', 'match', 'pattern' => "/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", 'message' => ''],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c01_id' => 'Productor',
            'c01_nombre' => 'Nombre',
            'c01_apaterno' => 'Primer apellido',
            'c01_amaterno' => 'Segundo apellido',
            'c01_curp' => 'CURP',
            'c01_rfc' => 'RFC',
            'c01_telefono' => 'Teléfono',
            'c01_colonia' => 'Colonia',
            'c01_calle' => 'Dirección',
            'c01_cp' => 'Código postal',
            'c01_localidad' => 'Localidad/Población',
            'c01_municipio' => 'Municipio',
            'c01_estado' => 'Estado',
            'c01_correo' => 'Correo electrónico',
            'c01_tipo' => 'Tipo de persona',
            'c01_razonsocial' => 'Razón social',
        ];
    }
    public static function getAllGanaderos() {
        $dropciones = Ganaderos::find()

            ->all();
        return ArrayHelper::map($dropciones, 'c01_id', function($model, $defaultValue) {
            if($model['c01_tipo']==1){
                return $model['c01_rfc'] . ' - ' . strtoupper($model['c01_razonsocial']);
            }else {
                return $model['c01_curp'] . ' - ' . strtoupper($model['c01_nombre']) . ' ' . strtoupper($model['c01_apaterno']) . ' ' . strtoupper($model['c01_amaterno']);
            }
        });
    }
    public static function getAllGanaderosCURP() {
        $dropciones = Ganaderos::find()->where('c01_curp is not null')->andWhere('c01_curp!=:vacio', [':vacio'=>''])

            ->all();
        return ArrayHelper::map($dropciones, 'c01_id', function($model, $defaultValue) {
            if($model['c01_tipo']==1){
                return $model['c01_rfc'];
            }else {
                return $model['c01_curp'];
            }
        });
    }
    public static function getAllGanaderosAsArraay() {
        $dropciones = \app\models\Ganaderos::find()->all();
        $i=0;
        foreach ($dropciones as $d){
            $data[$i]=$d->c01_apaterno." ".$d->c01_amaterno." ".$d->c01_nombre;
            //$data[$i][0]=$d->c01_nombre;
         $i++;
        }

        return $data;
    }

    public static  function getProductoresPorUpp($upp){
        $dropciones = PropietarioUnidad::find()->where('r01_id=:id', ['id'=>$upp])->all();

        return ArrayHelper::map($dropciones, 'c01_id', 'c01.c01_nombre');
    }

    public static function getAllProductoresNombre() {
        $dropciones = Ganaderos::find()
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }

        return ArrayHelper::map($dropciones, 'c01_id', function($model, $defaultValue) {
            return strtoupper(strtoupper($model['c01_nombre']. ' ' .$model['c01_apaterno']). ' ' . strtoupper($model['c01_amaterno']) );
        });
    }

    public static function getGanaderos() {
        $dropciones = Ganaderos::find()
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }

        return ArrayHelper::map($dropciones, 'c01_id', function($model, $defaultValue) {
            return strtoupper(strtoupper($model['c01_nombre']. ' ' .$model['c01_apaterno']). ' ' . strtoupper($model['c01_amaterno']) );
        });
    }

}
