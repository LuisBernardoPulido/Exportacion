<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r19_folios_nacional".
 *
 * @property integer $r19_id
 * @property integer $user_role
 * @property integer $r19_rangoInicio
 * @property integer $r19_rangoFin
 * @property integer $r19_usuAlta
 * @property string $r19_fecAlta
 * @property integer $r19_usuMod
 * @property string $r19_fecMod
 * @property integer $r19_tipo_dictamen
 */
class FoliosNacional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r19_folios_nacional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_role', 'r19_rangoInicio', 'r19_rangoFin'], 'required'],
            [['user_role', 'r19_rangoInicio', 'r19_rangoFin', 'r19_usuAlta', 'r19_usuMod', 'r19_tipo_dictamen'], 'integer'],
            [['r19_fecAlta', 'r19_fecMod'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r19_id' => 'ID',
            'user_role' => 'Usuarios Nacionales',
            'r19_rangoInicio' => 'Del Folio',
            'r19_rangoFin' => 'Al Folio',
            'r19_usuAlta' => 'Usuario Alta',
            'r19_fecAlta' => 'Fecha de Alta',
            'r19_usuMod' => 'Usu Mod',
            'r19_fecMod' => 'Fec Mod',
            'r19_tipo_dictamen' => 'Tipo de Dictamen',
        ];
    }
}
