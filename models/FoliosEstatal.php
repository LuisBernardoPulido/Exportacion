<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r20_folios_estatal".
 *
 * @property integer $r20_id
 * @property integer $user_role
 * @property integer $r20_rangoInicio
 * @property integer $r20_rangoFin
 * @property integer $r20_usuAlta
 * @property string $r20_fecAlta
 * @property integer $r20_usuMod
 * @property string $r20_fecMod
 * @property integer $r20_tipo_dictamen
 */
class FoliosEstatal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r20_folios_estatal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_role', 'r20_rangoInicio', 'r20_rangoFin'], 'required'],
            [['user_role', 'r20_rangoInicio', 'r20_rangoFin', 'r20_usuAlta', 'r20_usuMod', 'r20_tipo_dictamen'], 'integer'],
            [['r20_fecAlta', 'r20_fecMod'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r20_id' => 'R20 ID',
            'user_role' => 'Usuarios Estatales',
            'r20_rangoInicio' => 'Del Folio',
            'r20_rangoFin' => 'Al Folio',
            'r20_usuAlta' => 'Usuario Alta',
            'r20_fecAlta' => 'Fecha de Alta',
            'r20_usuMod' => 'Usuario Modificó',
            'r20_fecMod' => 'Fecha de Modificación',
            'r20_tipo_dictamen' => 'Tipo de Dictamen',
        ];
    }
}
