<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sl01_capturas_salida".
 *
 * @property integer $sl01_id
 * @property integer $sl01_especie
 * @property string $sl01_salFechaSalida
 * @property string $sl01_salGuia
 * @property string $sl01_salCertZoo
 * @property string $sl01_salFolioTb
 * @property string $sl01_salFolioGarr
 * @property string $sl01_salFleje
 * @property string $sl01_salDestino
 * @property string $sl01_salDomicilio
 * @property integer $sl01_salEstado
 * @property integer $sl01_salMunicipio
 * @property string $sl01_salRastro
 * @property string $sl01_salObservaciones
 * @property integer $sl01_activo
 * @property integer $sl01_usuAlta
 * @property string $sl01_fecAlta
 * @property integer $sl01_usuMod
 * @property string $sl01_fecMod
 */
class CapturasSalida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sl01_capturas_salida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sl01_id'], 'required'],
            [['sl01_id', 'sl01_especie', 'sl01_salEstado', 'sl01_salMunicipio', 'sl01_activo', 'sl01_usuAlta', 'sl01_usuMod'], 'integer'],
            [['sl01_salFechaSalida', 'sl01_fecAlta', 'sl01_fecMod'], 'safe'],
            [['sl01_salGuia', 'sl01_salCertZoo', 'sl01_salFolioTb', 'sl01_salFolioGarr', 'sl01_salFleje', 'sl01_salRastro'], 'string', 'max' => 30],
            [['sl01_salDestino', 'sl01_salDomicilio', 'sl01_salObservaciones'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sl01_id' => 'Sl01 ID',
            'sl01_especie' => 'Sl01 Especie',
            'sl01_salFechaSalida' => 'Sl01 Sal Fecha Salida',
            'sl01_salGuia' => 'Sl01 Sal Guia',
            'sl01_salCertZoo' => 'Sl01 Sal Cert Zoo',
            'sl01_salFolioTb' => 'Sl01 Sal Folio Tb',
            'sl01_salFolioGarr' => 'Sl01 Sal Folio Garr',
            'sl01_salFleje' => 'Sl01 Sal Fleje',
            'sl01_salDestino' => 'Sl01 Sal Destino',
            'sl01_salDomicilio' => 'Sl01 Sal Domicilio',
            'sl01_salEstado' => 'Sl01 Sal Estado',
            'sl01_salMunicipio' => 'Sl01 Sal Municipio',
            'sl01_salRastro' => 'Sl01 Sal Rastro',
            'sl01_salObservaciones' => 'Sl01 Sal Observaciones',
            'sl01_activo' => 'Sl01 Activo',
            'sl01_usuAlta' => 'Sl01 Usu Alta',
            'sl01_fecAlta' => 'Sl01 Fec Alta',
            'sl01_usuMod' => 'Sl01 Usu Mod',
            'sl01_fecMod' => 'Sl01 Fec Mod',
        ];
    }
}
