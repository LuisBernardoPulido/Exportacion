<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r18_informacion_dictamen".
 *
 * @property integer $r18_id
 * @property string $r18_tipo_dictamen
 * @property integer $p03_id
 * @property integer $c01_id
 * @property string $c01_apaterno
 * @property string $c01_amaterno
 * @property string $c01_nombre
 * @property string $c01_telefono
 * @property string $c01_domicilio
 * @property string $c01_municipio
 * @property string $c01_localidad
 * @property string $c01_estado
 * @property string $c01_correo
 * @property integer $r01_id
 * @property string $r01_nombre
 * @property string $r01_latitud
 * @property string $r01_longitud
 * @property string $r01_clave
 * @property string $r01_domicilio
 * @property string $r01_municipio
 * @property string $r01_localidad
 * @property string $r01_estado
 * @property integer $c05_id
 * @property string $c05_nombre
 * @property string $c05_clave
 * @property string $c05_vigencia
 */
class InformacionDictamen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r18_informacion_dictamen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r18_tipo_dictamen', 'c05_tipomvz'], 'string'],
            [['p03_id', 'c01_id', 'r01_id', 'c05_id'], 'integer'],
            [['c05_vigencia'], 'safe'],
            [['c01_apaterno', 'c01_amaterno', 'c01_nombre', 'r01_latitud', 'r01_longitud'], 'string', 'max' => 80],
            [['c01_telefono'], 'string', 'max' => 20],
            [['c01_domicilio', 'r01_domicilio'], 'string', 'max' => 150],
            [['c01_municipio', 'c01_localidad', 'c01_estado', 'c01_correo', 'r01_nombre', 'r01_municipio', 'r01_localidad', 'r01_estado'], 'string', 'max' => 100],
            [['r01_clave', 'c05_clave'], 'string', 'max' => 50],
            [['c05_nombre'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r18_id' => 'R18 ID',
            'r18_tipo_dictamen' => 'R18 Tipo Dictamen',
            'p03_id' => 'P03 ID',
            'c01_id' => 'C01 ID',
            'c01_apaterno' => 'C01 Apaterno',
            'c01_amaterno' => 'C01 Amaterno',
            'c01_nombre' => 'C01 Nombre',
            'c01_telefono' => 'C01 Telefono',
            'c01_domicilio' => 'C01 Domicilio',
            'c01_municipio' => 'C01 Municipio',
            'c01_localidad' => 'C01 Localidad',
            'c01_estado' => 'C01 Estado',
            'c01_correo' => 'C01 Correo',
            'r01_id' => 'R01 ID',
            'r01_nombre' => 'R01 Nombre',
            'r01_latitud' => 'R01 Latitud',
            'r01_longitud' => 'R01 Longitud',
            'r01_clave' => 'R01 Clave',
            'r01_domicilio' => 'R01 Domicilio',
            'r01_municipio' => 'R01 Municipio',
            'r01_localidad' => 'R01 Localidad',
            'r01_estado' => 'R01 Estado',
            'c05_id' => 'C05 ID',
            'c05_nombre' => 'C05 Nombre',
            'c05_clave' => 'C05 Clave',
            'c05_vigencia' => 'C05 Vigencia',
        ];
    }
}
