<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r15_folios_supervisor".
 *
 * @property integer $r15_id
 * @property integer $c05_id
 * @property string $r15_rangoInicio
 * @property string $r15_rangoFin
 * @property integer $r15_usuAlta
 * @property string $r15_fecAlta
 * @property integer $r15_usuMod
 * @property string $r15_fecMod
 */
class FoliosSupervisor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r15_folios_supervisor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_id', 'r15_rangoInicio', 'r15_rangoFin'], 'required'],
            [['c05_id', 'r15_usuAlta', 'r15_usuMod'], 'integer'],
            [['r15_fecAlta', 'r15_fecMod'], 'safe'],
            [['r15_rangoInicio', 'r15_rangoFin'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r15_id' => 'R15 ID',
            'c05_id' => 'Médico Supervisor',
            'r15_rangoInicio' => 'Del Folio',
            'r15_rangoFin' => 'Al Folio',
            'r15_usuAlta' => 'Usuario Alta',
            'r15_fecAlta' => 'Fecha de Alta',
            'r15_usuMod' => 'R15 Usu Mod',
            'r15_fecMod' => 'R15 Fec Mod',
            'r15_tipo_dictamen' => 'Tipo de Dictamen',
        ];
    }
}
