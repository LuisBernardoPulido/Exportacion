<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r29_solicitud_exportacion_aretes".
 *
 * @property integer $r29_id
 * @property integer $r28_id
 * @property integer $r29_resultado
 * @property integer $r29_razon
 * @property integer $r29_usuAlta
 * @property integer $p12_id
 * @property integer $r29_usuMod
 * @property string $r29_fecAlta
 * @property string $r29_fecMod
 *
 * @property ExportacionAretes $r28
 */
class SolicitudesExportacionesAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r29_solicitud_exportacion_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r28_id'], 'required'],
            [['r28_id', 'r29_resultado', 'r29_razon', 'r29_usuAlta', 'r29_usuMod'], 'integer'],
            [['r29_fecAlta', 'r29_fecMod'], 'safe'],
            [['r28_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExportacionAretes::className(), 'targetAttribute' => ['r28_id' => 'r28_id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r29_id' => 'ID',
            'r28_id' => 'ID Entrada',
            'r29_resultado' => '0:Si exportable, 1:No exportable',
            'r29_razon' => 'Razon de exportacion',
            'r29_usuAlta' => 'Usuario de alta',
            'p12_id' => 'Solicitud',
            'r29_usuMod' => 'Usuario de modificacion',
            'r29_fecAlta' => 'Fecha de alta',
            'r29_fecMod' => 'Fecha de modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR28()
    {
        return $this->hasOne(ExportacionAretes::className(), ['r28_id' => 'r28_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP12()
    {
        return $this->hasOne(Exportacion::className(), ['p12_id' => 'p12_id']);
    }
}
