<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "p05_parametros".
 *
 * @property integer $p05_id
 * @property string $p05_nombre
 * @property string $p05_valor
 * @property integer $p05_tipo
 * @property integer $p05_activo
 * @property integer $p05_usuAlta
 * @property string $p05_fecAlta
 * @property integer $p05_usuMod
 * @property string $p05_fecMod
 */
class Parametros extends \yii\db\ActiveRecord
{
    const COMBO_TIPO = 0;
    const TEXT = 1;
    const NUMBER = 2;
    const EMAIL = 3;
    const TEXTAREA = 4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p05_parametros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p05_nombre', 'p05_valor', 'p05_tipo', 'p05_activo'], 'required'],
            [['p05_tipo', 'p05_activo', 'p05_usuAlta', 'p05_usuMod'], 'integer'],
            [['p05_fecAlta', 'p05_fecMod'], 'safe'],
            [['p05_nombre'], 'string', 'max' => 150],
            [['p05_valor'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p05_id' => 'ID Parametro',
            'p05_nombre' => 'Nombre notificación',
            'p05_valor' => 'Correo eléctronico',
            'p05_tipo' => 'Tipo de Dictámen',
            'p05_activo' => 'Estatus del registro',
            'p05_usuAlta' => 'Usuario Alta',
            'p05_fecAlta' => 'Fecha Alta',
            'p05_usuMod' => 'Usuario Modificación',
            'p05_fecMod' => 'Fecha de Modificación',
            'accion' => 'Acción',
        ];
    }
}
