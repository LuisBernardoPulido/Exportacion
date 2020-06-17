<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r17_folios_coordinador".
 *
 * @property integer $r17_id
 * @property integer $c05_id
 * @property integer $r17_rangoInicio
 * @property integer $r17_rangoFin
 * @property integer $r17_usuAlta
 * @property string $r17_fecAlta
 * @property integer $r17_usuMod
 * @property string $r17_fecMod
 * @property integer $r17_tipo_dictamen
 */
class FoliosCoordinador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r17_folios_coordinador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_id', 'r17_rangoInicio', 'r17_rangoFin'], 'required'],
            [['c05_id', 'r17_rangoInicio', 'r17_rangoFin', 'r17_usuAlta', 'r17_usuMod', 'r17_tipo_dictamen'], 'integer'],
            [['r17_fecAlta', 'r17_fecMod'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r17_id' => 'R17 ID',
            'c05_id' => 'Coordinadores',
            'r17_rangoInicio' => 'Del Folio',
            'r17_rangoFin' => 'Al Folio',
            'r17_usuAlta' => 'Usuario Alta',
            'r17_fecAlta' => 'Fecha de Alta',
            'r17_usuMod' => 'R17 Usu Mod',
            'r17_fecMod' => 'R17 Fec Mod',
            'r17_tipo_dictamen' => 'Tipo de Dictamen',
        ];
    }
}
