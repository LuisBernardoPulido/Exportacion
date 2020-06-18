<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "p09_solicitudes".
 *
 * @property integer $p09_id
 * @property string $p09_referencia
 * @property integer $r01_id
 * @property integer $p09_usuAlta
 * @property string $p09_fecAlta
 * @property integer $p09_usuMod
 * @property string $p09_fecMod
 *
 * @property R27SolicitudAretes[] $r27SolicitudAretes
 */
class Solicitudes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p09_solicitudes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r01_id', 'p09_usuAlta', 'p09_usuMod'], 'integer'],
            [['p09_fecAlta', 'p09_fecMod'], 'safe'],
            [['p09_referencia'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p09_id' => 'ID solicitud',
            'p09_referencia' => 'Referencia',
            'r01_id' => 'PSG',
            'p09_usuAlta' => 'Usuario de alta',
            'p09_fecAlta' => 'P09 Fec Alta',
            'p09_usuMod' => 'Usuario modificación',
            'p09_fecMod' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR27SolicitudAretes()
    {
        return $this->hasMany(R27SolicitudAretes::className(), ['p09_id' => 'p09_id']);
    }
}
