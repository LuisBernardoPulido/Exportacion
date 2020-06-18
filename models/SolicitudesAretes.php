<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r27_solicitud_aretes".
 *
 * @property integer $r27_id
 * @property integer $p09_id
 * @property integer $r01_id
 * @property integer $c01_id
 * @property integer $r27_usuAlta
 * @property string $r27_fecAlta
 * @property integer $r27_usuMod
 * @property string $r27_fecMod
 *
 * @property P09Solicitudes $p09
 */
class SolicitudesAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r27_solicitud_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r27_id'], 'required'],
            [['r27_id', 'p09_id', 'r01_id', 'c01_id', 'r27_usuAlta', 'r27_usuMod'], 'integer'],
            [['r27_fecAlta', 'r27_fecMod'], 'safe'],
            [['p09_id'], 'exist', 'skipOnError' => true, 'targetClass' => P09Solicitudes::className(), 'targetAttribute' => ['p09_id' => 'p09_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r27_id' => 'ID Arete',
            'p09_id' => 'Solicitud',
            'r01_id' => 'UPP',
            'c01_id' => 'Ganadero',
            'r27_usuAlta' => 'UsuAlta',
            'r27_fecAlta' => 'Fecha de alta',
            'r27_usuMod' => 'Usuario modificación',
            'r27_fecMod' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP09()
    {
        return $this->hasOne(Solicitudes::className(), ['p09_id' => 'p09_id']);
    }

    public static function getAretes($id){
        $aretes = SolicitudesAretes::find()
            ->where('p09_id=:id', [':id'=>'1']);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
