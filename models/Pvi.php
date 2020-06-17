<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "c16_pvi".
 *
 * @property integer $c16_id
 * @property string $c16_numero
 * @property string $c16_responsable
 * @property string $c16_telefono
 * @property string $c16_colonia
 * @property string $c16_calle
 * @property string $c16_cp
 * @property string $c16_localidad
 * @property string $c16_municipio
 * @property string $c16_estado
 * @property string $c16_email
 * @property string $c16_estatus
 */
class Pvi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c16_pvi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c16_responsable', 'c16_numero', 'c16_municipio', 'c16_estado'], 'required'],
            [['c16_estatus'], 'string'],
            [['c16_numero'], 'string', 'max' => 10],
            [['c16_responsable'], 'string', 'max' => 200],
            [['c16_telefono', 'c16_colonia', 'c16_localidad', 'c16_municipio', 'c16_estado', 'c16_email', 'c16_latitud', 'c16_longitud'], 'string', 'max' => 50],
            [['c16_calle'], 'string', 'max' => 100],
            [['c16_cp'], 'string', 'max' => 5],
            [['c16_numero'], 'unique'],
            ['c16_email', 'match', 'pattern' => "/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", 'message' => 'Email Inválido'],
            ['c16_cp', 'string', 'length' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c16_id' => 'ID',
            'c16_numero' => 'Numero de PVI',
            'c16_responsable' => 'Responsable',
            'c16_telefono' => 'Telefono',
            'c16_colonia' => 'Colonia',
            'c16_calle' => 'Calle',
            'c16_cp' => 'Código Postal',
            'c16_localidad' => 'Localidad',
            'c16_municipio' => 'Municipio',
            'c16_estado' => 'Estado',
            'c16_email' => 'Email',
            'c16_estatus' => 'Estatus',
            'c16_latitud' => 'Latitud',
            'c16_longitud' => 'Longitud',
        ];
    }
}
