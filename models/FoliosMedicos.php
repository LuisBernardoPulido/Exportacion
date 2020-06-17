<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r16_folios_medicos".
 *
 * @property integer $r16_id
 * @property integer $c05_id
 * @property integer $p03_id
 * @property integer $r16_tipo_dictamen
 * @property integer $r16_folio_asignado
 * @property integer $r16_usuAlta
 * @property string $r16_fecAlta
 * @property integer $r16_usuMod
 * @property string $r16_fecMod
 */
class FoliosMedicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r16_folios_medicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_id', 'p03_id', 'r16_tipo_dictamen', 'r16_folio_asignado', 'r16_usuAlta', 'r16_usuMod', 'r16_estatus'], 'integer'],
            [['r16_fecAlta', 'r16_fecMod'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r16_id' => 'R16 ID',
            'c05_id' => 'Médico que Dictaminó',
            'p03_id' => 'Dictamen',
            'r16_tipo_dictamen' => 'Tipo de Dictamen',
            'r16_folio_asignado' => 'Folio Asignado',
            'r16_usuAlta' => 'Usuario que Asignó Folio',
            'r16_fecAlta' => 'Fecha de Alta',
            'r16_usuMod' => 'R16 Usu Mod',
            'r16_fecMod' => 'R16 Fec Mod',
            'r16_estatus' => 'Estatus',
            'r16_fecha_folio' => 'Fecha de Asignación de Folio',
            'r16_entregado' => 'Dictamen Entregado',
            'r16_fecha_entregado' => 'Fecha de Entrega',

        ];
    }
}
