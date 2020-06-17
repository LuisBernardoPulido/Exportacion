<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "p04_reemo".
 *
 * @property integer $p04_id
 * @property integer $r01_origen
 * @property integer $r01_destino
 * @property integer $c14_motivo
 * @property string $p04_no_reemo
 * @property string $p0_fecExped
 * @property integer $p04_usuAlta
 * @property string $p04_fecAlta
 * @property integer $p04_usuMod
 * @property string $p04_fecMod
 */
class ReemoManual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p04_reemo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p04_id', 'r01_origen', 'r01_destino', 'c14_motivo', 'p04_usuAlta', 'p04_usuMod'], 'integer'],
            [['r01_origen', 'r01_destino', 'c14_motivo', 'p04_num_reemo'], 'required'],
            [[ 'p04_fecExpe', 'p04_fecAlta', 'p04_fecMod'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'p04_id' => 'P04 ID',
            'r01_origen' => 'UPP Origen',
            'r01_destino' => 'UPP Destino',
            'c14_motivo' => 'Motivo',
            'p04_num_reemo' => 'Número de Reemo',
            'p04_fecExpe' => 'Fecha de Expedición',
            'p04_usuAlta' => 'Usuario Alta',
            'p04_fecAlta' => 'Fecha de Alta',
            'p04_usuMod' => 'Usuario Modificación',
            'p04_fecMod' => 'Fecha de Modificación',
        ];
    }
}
