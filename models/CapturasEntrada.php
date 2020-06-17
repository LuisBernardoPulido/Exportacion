<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sl01_capturas_entrada".
 *
 * @property integer $sl01_id
 * @property integer $sl01_especie
 * @property string $sl01_entFolioPermiso
 * @property string $sl01_entFechaIngreso
 * @property string $sl01_entJaula
 * @property string $sl01_entCertZoo
 * @property string $sl01_entFolioTb
 * @property string $sl01_entFolioBr
 * @property string $sl01_entGuia
 * @property string $sl01_entFleje
 * @property string $sl01_entObservaciones
 * @property integer $sl01_activo
 * @property integer $sl01_usuAlta
 * @property string $sl01_fecAlta
 * @property integer $sl01_usuMod
 * @property string $sl01_fecMod
 */
class CapturasEntrada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sl01_capturas_entrada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sl01_id'], 'required'],
            [['sl01_id', 'sl01_especie', 'sl01_activo', 'sl01_usuAlta', 'sl01_usuMod'], 'integer'],
            [['sl01_entFechaIngreso', 'sl01_fecAlta', 'sl01_fecMod'], 'safe'],
            [['sl01_entFolioPermiso', 'sl01_entJaula', 'sl01_entCertZoo', 'sl01_entFolioTb', 'sl01_entFolioBr', 'sl01_entGuia', 'sl01_entFleje'], 'string', 'max' => 30],
            [['sl01_entObservaciones'], 'string', 'max' => 100],
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
            'sl01_entFolioPermiso' => 'Sl01 Ent Folio Permiso',
            'sl01_entFechaIngreso' => 'Sl01 Ent Fecha Ingreso',
            'sl01_entJaula' => 'Sl01 Ent Jaula',
            'sl01_entCertZoo' => 'Sl01 Ent Cert Zoo',
            'sl01_entFolioTb' => 'Sl01 Ent Folio Tb',
            'sl01_entFolioBr' => 'Sl01 Ent Folio Br',
            'sl01_entGuia' => 'Sl01 Ent Guia',
            'sl01_entFleje' => 'Sl01 Ent Fleje',
            'sl01_entObservaciones' => 'Sl01 Ent Observaciones',
            'sl01_activo' => 'Sl01 Activo',
            'sl01_usuAlta' => 'Sl01 Usu Alta',
            'sl01_fecAlta' => 'Sl01 Fec Alta',
            'sl01_usuMod' => 'Sl01 Usu Mod',
            'sl01_fecMod' => 'Sl01 Fec Mod',
        ];
    }
}
