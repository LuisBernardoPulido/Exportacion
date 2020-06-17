<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r04_prop_unit".
 *
 * @property integer $r04_id
 * @property integer $r01_id
 * @property integer $r04_psg
 * @property integer $c01_id
 * @property string $r04_fierro
 * @property integer $r04_usuAlta
 * @property string $r04_fecAlta
 *
 * @property R01Upp $r01
 * @property C01Ganaderos $c01
 */
class PropietarioUnidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r04_prop_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['r01_id', 'r04_psg', 'c01_id', 'r04_usuAlta'], 'integer'],
            [['r04_fecAlta'], 'safe'],
            [['r04_fierro'], 'string', 'max' => 200],
            [['r01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_id' => 'r01_id']],
            [['c01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ganaderos::className(), 'targetAttribute' => ['c01_id' => 'c01_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r04_id' => 'ID Relación',
            'r01_id' => 'ID Rancho',
            'r04_psg' => 'ID PSG',
            'c01_id' => 'ID Ganadero',
            'r04_fierro' => 'Fierro',
            'r04_usuAlta' => 'Usuario Alta',
            'r04_fecAlta' => 'Fecha Alta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR01()
    {
        return $this->hasOne(Upp::className(), ['r01_id' => 'r01_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC01()
    {
        return $this->hasOne(Ganaderos::className(), ['c01_id' => 'c01_id']);
    }


    public static function getRelacionesNulas(){
        $rel = PropietarioUnidad::find()
            ->where('c01_id is NULL');

        $dataprovider = new ActiveDataProvider([
            'query' => $rel,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getRelacionesNulasUnidades(){
        $rel = PropietarioUnidad::find()
            ->where('r01_id is NULL');

        $dataprovider = new ActiveDataProvider([
            'query' => $rel,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    public static function getUnidPerPropietario($id){
        $rel = PropietarioUnidad::find()
            ->where('c01_id=:activo',[':activo'=>$id]);

        $dataprovider = new ActiveDataProvider([
            'query' => $rel,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }



    public static function getPropPerUnidad($id){
        $rel = PropietarioUnidad::find()
            ->where('r01_id=:activo',[':activo'=>$id]);

        $dataprovider = new ActiveDataProvider([
            'query' => $rel,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

}
