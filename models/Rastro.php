<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "p08_rastro".
 *
 * @property integer $p08_id
 * @property integer $r01_origen
 * @property integer $r01_destino
 * @property integer $c14_motivo
 * @property string $p08_num_rastro
 * @property integer $p08_usuAlta
 * @property string $p08_fecAlta
 * @property integer $p08_usuMod
 * @property string $p08_fecMod
 */
class Rastro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p08_rastro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r01_origen', 'r01_destino', 'p08_usuAlta'], 'required'],
            [['r01_origen', 'r01_destino', 'c14_motivo', 'p08_usuAlta', 'p08_usuMod'], 'integer'],
            [['p08_fecAlta', 'p08_fecMod'], 'safe'],
            [['p08_num_rastro'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'p08_id' => 'P08 ID',
            'r01_origen' => 'UPP Origen',
            'r01_destino' => 'UPP Destino',
            'c14_motivo' => 'Motivo',
            'p08_num_rastro' => 'Num Rastro',
            //'p08_usuAlta' => 'P08 Usu Alta',
            //'p08_fecAlta' => 'P08 Fec Alta',
            //'p08_usuMod' => 'P08 Usu Mod',
            //'p08_fecMod' => 'P08 Fec Mod',
        ];
    }
}
