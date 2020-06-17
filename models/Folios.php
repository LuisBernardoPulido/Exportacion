<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r08_folios_dictamenes".
 *
 * @property integer $r08_id
 * @property integer $p03_br
 * @property integer $p03_tb
 * @property integer $p03_vc
 * @property integer $r08_folio
 * @property string $r08_motivo
 * @property integer $r08_usuAlta
 * @property string $r08_fecAlta
 * @property integer $r08_usuMod
 * @property string $r08_fecMod
 *
 * @property P03Br $p03Br
 * @property P03Tb $p03Tb
 */
class Folios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r08_folios_dictamenes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p03_br', 'p03_tb', 'p03_vc', 'r08_folio', 'r08_usuAlta', 'r08_usuMod'], 'integer'],
            [['r08_folio'], 'required'],
            [['r08_fecAlta', 'r08_fecMod'], 'safe'],
            [['r08_motivo'], 'string', 'max' => 200],
            [['p03_br'], 'exist', 'skipOnError' => true, 'targetClass' => Brucelosis::className(), 'targetAttribute' => ['p03_br' => 'p03_id']],
            [['p03_tb'], 'exist', 'skipOnError' => true, 'targetClass' => Tuberculosis::className(), 'targetAttribute' => ['p03_tb' => 'p03_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r08_id' => 'ID Registro',
            'p03_br' => 'BR',
            'p03_tb' => 'TB',
            'p03_vc' => 'VC',
            'r08_folio' => 'No. de folio',
            'r08_motivo' => 'Motivo',
            'r08_usuAlta' => 'Usuario de Alta',
            'r08_fecAlta' => 'Fecha de Alta',
            'r08_usuMod' => 'Usuario de Modificación',
            'r08_fecMod' => 'Fecha de Modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03Br()
    {
        return $this->hasOne(P03Br::className(), ['p03_id' => 'p03_br']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03Tb()
    {
        return $this->hasOne(P03Tb::className(), ['p03_id' => 'p03_tb']);
    }
    public static function getTBPorUnidad($upp){
        $tb = Tuberculosis::find()
            ->where('r01_id=:id', [':id'=>$upp])
            ->andWhere('p03_isdictaminado=1')
            ->andWhere('p03_folio is not null');

        $dataprovider = new ActiveDataProvider([
            'query' => $tb,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getBRPorUnidad($upp){
        $tb = Brucelosis::find()
            ->where('r01_id=:id', [':id'=>$upp])
            ->andWhere('p03_isdictaminado=1')
            ->andWhere('p03_folio is not null');

        $dataprovider = new ActiveDataProvider([
            'query' => $tb,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getVCPorUnidad($upp){
        $tb = Vacunacion::find()
            ->where('r01_id=:id', [':id'=>$upp])
            ->andWhere('p03_isdictaminado=1')
            ->andWhere('p03_folio is not null');

        $dataprovider = new ActiveDataProvider([
            'query' => $tb,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

}

