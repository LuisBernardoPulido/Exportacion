<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "c17_responsables_pvi".
 *
 * @property integer $c17_id
 * @property string $c17_clave
 * @property string $c17_nombre
 * @property string $c17_apaterno
 * @property string $c17_amaterno
 * @property string $c17_nombre_completo
 * @property string $c17_rfc
 * @property string $c17_telefono
 * @property string $c17_colonia
 * @property string $c17_calle
 * @property string $c17_cp
 * @property string $c17_localidad
 * @property string $c17_municipio
 * @property string $c17_estado
 * @property string $c17_correo
 * @property string $c17_estatus
 */
class ResponsablesPvi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c17_responsables_pvi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c17_clave', 'c17_nombre', 'c17_apaterno', 'c17_nombre_completo', 'c17_rfc'], 'required'],
            [['c17_estatus'], 'string'],
            [['c17_clave', 'c17_rfc', 'c17_telefono', 'c17_colonia', 'c17_calle', 'c17_municipio', 'c17_estado', 'c17_correo'], 'string', 'max' => 50],
            [['c17_nombre', 'c17_apaterno', 'c17_amaterno', 'c17_localidad'], 'string', 'max' => 100],
            [['c17_nombre_completo'], 'string', 'max' => 250],
            [['c17_cp'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c17_id' => 'ID',
            'c17_clave' => 'Clave',
            'c17_nombre' => 'Nombre',
            'c17_apaterno' => 'Primer apellido',
            'c17_amaterno' => 'Segundo apellido',
            'c17_nombre_completo' => 'Nombre Completo',
            'c17_rfc' => 'RFC',
            'c17_telefono' => 'Telefono',
            'c17_colonia' => 'Colonia',
            'c17_calle' => 'Calle',
            'c17_cp' => 'Cp',
            'c17_localidad' => 'Localidad',
            'c17_municipio' => 'Municipio',
            'c17_estado' => 'Estado',
            'c17_correo' => 'Correo',
            'c17_estatus' => 'Estatus',
        ];
    }
}
