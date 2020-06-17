<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r21_folios_administrador".
 *
 * @property integer $r21_id
 * @property integer $user_role
 * @property integer $r21_rangoInicio
 * @property integer $r21_rangoFin
 * @property integer $r21_usuAlta
 * @property string $r21_fecAlta
 * @property integer $r21_usuMod
 * @property string $r21_fecMod
 * @property integer $r21_tipo_dictamen
 */
class FoliosAdministrador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r21_folios_administrador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_role', 'r21_rangoInicio', 'r21_rangoFin'], 'required'],
            [['user_role', 'r21_rangoInicio', 'r21_rangoFin', 'r21_usuAlta', 'r21_usuMod', 'r21_tipo_dictamen'], 'integer'],
            [['r21_fecAlta', 'r21_fecMod'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r21_id' => 'ID',
            'user_role' => 'Usuarios Administradores',
            'r21_rangoInicio' => 'Del Folio',
            'r21_rangoFin' => 'Al Folio',
            'r21_usuAlta' => 'Usuario Alta',
            'r21_fecAlta' => 'Fecha Alta',
            'r21_usuMod' => 'Usuario Modificó',
            'r21_fecMod' => 'Fecha de Modificación',
            'r21_tipo_dictamen' => 'Tipo de Dictamen',
        ];
    }
}
