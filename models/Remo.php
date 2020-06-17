<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "p04_registro_movilidad".
 *
 * @property integer $p04_id
 * @property integer $r01_origen
 * @property integer $r01_destino
 * @property integer $r02_id
 * @property string $r02_edad
 * @property integer $r02_raza
 * @property integer $r02_raza2
 * @property integer $r02_sexo
 * @property integer $r02_especie
 * @property integer $c14_motivo
 * @property integer $p04_usuAlta
 * @property string $p04_fecAlta
 * @property integer $p04_usuMod
 * @property string $p04_fecMod
 * @property string $p04_no_reemo
 *
 * @property R01Upp $r01Origen
 * @property R01Upp $r01Destino
 * @property R02Aretes $r02
 * @property C14MotivoRemo $c14Motivo
 */
class Remo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p04_registro_movilidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r01_origen', 'r01_destino', 'r02_id', 'p04_usuAlta'], 'required'],
            [['r01_origen', 'r01_destino', 'r02_id', 'r02_raza', 'r02_raza2', 'r02_sexo', 'r02_especie', 'c14_motivo', 'p04_usuAlta', 'p04_usuMod'], 'integer'],
            [['p04_fecAlta', 'p04_fecMod'], 'safe'],
            [['p04_no_reemo'], 'string', 'max' => 30],
            [['r02_edad'], 'string', 'max' => 100],
            [['r01_origen'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_origen' => 'r01_id']],
            [['r01_destino'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_destino' => 'r01_id']],
            [['r02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aretes::className(), 'targetAttribute' => ['r02_id' => 'r02_id']],
            [['c14_motivo'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoRemo::className(), 'targetAttribute' => ['c14_motivo' => 'c14_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p04_id' => 'ID Registro',
            'r01_origen' => 'Upp Origen',
            'r01_destino' => 'Upp Destino',
            'r02_id' => 'Arete',
            'r02_edad' => 'Edad',
            'r02_raza' => 'Raza',
            'r02_raza2' => 'Raza Cruza',
            'r02_sexo' => 'Sexo',
            'r02_especie' => 'Especie',
            'c14_motivo' => 'Motivo de movimiento',
            'p04_usuAlta' => 'Usuario Alta',
            'p04_fecAlta' => 'Fecha Alta',
            'p04_usuMod' => 'Usuario Modificación',
            'p04_fecMod' => 'Fecha Modificación',
            'p04_no_reemo' => 'No. REEMO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR01Origen()
    {
        return $this->hasOne(R01Upp::className(), ['r01_id' => 'r01_origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR01Destino()
    {
        return $this->hasOne(R01Upp::className(), ['r01_id' => 'r01_destino']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR02()
    {
        return $this->hasOne(R02Aretes::className(), ['r02_id' => 'r02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC14Motivo()
    {
        return $this->hasOne(C14MotivoRemo::className(), ['c14_id' => 'c14_motivo']);
    }
    public static function getMovimientosPorArete($id){
        $ar = Aretes::find()->where('r02_numero=:num', [':num'=>$id])->one();
        if($ar){
            $aretes = Remo::find()
                ->where('r02_id=:id', [':id'=>$ar->r02_id]);
        }else{
            $aretes = Remo::find()
                ->where('r02_id=:id', [':id'=>1]);
        }


        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
