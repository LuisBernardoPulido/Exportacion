<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c18_rutas".
 *
 * @property integer $c18_id
 * @property string $c18_nombre
 * @property string $c18_clave
 * @property string $c18_municipio
 * @property string $c18_estado
 * @property string $c18_ruta1
 * @property string $c18_ruta2
 * @property string $c18_ruta3
 * @property integer $c18_usuAlta
 * @property string $c18_fecAlta
 * @property integer $c18_usuMod
 * @property string $c18_fecMod
 * @property string $c18_estatus
 */
class Rutas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c18_rutas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c18_nombre', 'c18_clave', 'c18_municipio', 'c18_estado', 'c18_ruta1', 'c18_usuAlta', 'c18_estatus'], 'required'],
            [['c18_usuAlta', 'c18_usuMod'], 'integer'],
            [['c18_fecAlta', 'c18_fecMod'], 'safe'],
            [['c18_estatus'], 'string'],
            [['c18_nombre', 'c18_ruta1', 'c18_ruta2', 'c18_ruta3'], 'string', 'max' => 150],
            [['c18_clave', 'c18_municipio', 'c18_estado'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c18_id' => 'ID de Ruta',
            'c18_nombre' => 'Nombre de la Ruta',
            'c18_clave' => 'Clave',
            'c18_municipio' => 'Municipio',
            'c18_estado' => 'Estado',
            'c18_ruta1' => 'Ruta 1',
            'c18_ruta2' => 'Ruta 2',
            'c18_ruta3' => 'Ruta 3',
            'c18_usuAlta' => 'Usuario Alta',
            'c18_fecAlta' => 'Fecha de Alta',
            'c18_usuMod' => 'Usuario que Modificó',
            'c18_fecMod' => 'Fecha Modificación',
            'c18_estatus' => 'Estatus',
        ];
    }

    public static function getRutas(){
        $sql = 'select * from c18_rutas where c18_estatus=2 ';

        $rutas = Rutas::findBySql($sql)->all();

        return ArrayHelper::map($rutas, 'c18_id', function($model, $defaultValue) {
            return strtoupper($model['c18_nombre']);
        });
    }
}
