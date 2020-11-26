<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "p11_solicitud_exportacion".
 *
 * @property integer $p11_id
 * @property integer $p11_guia
 * @property string $p11_fecha
 * @property integer $r01_origen
 * @property integer $r01_destino
 * @property integer $c01_id
 * @property integer $p11_motivo
 * @property integer $p11_especie
 * @property string $p11_aux
 * @property integer $p11_usuAlta
 * @property string $p11_fecAlta
 * @property integer $p11_usuMod
 * @property string $p11_fecMod
 *
 * @property Upp $r01Origen
 * @property Upp $r01Destino
 * @property Ganaderos $c01
 */
class Exportacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p11_solicitud_exportacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p11_guia', 'r01_destino','r01_origen'], 'required'],
            [[ 'r01_origen', 'r01_destino', 'c01_id', 'p11_especie', 'p11_usuAlta', 'p11_usuMod'], 'integer'],
            [['p11_fecha', 'p11_fecAlta', 'p11_fecMod'], 'safe'],
            [['p11_aux', 'p11_motivo', 'p11_guia'], 'string', 'max' => 50],
            [['r01_origen'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_origen' => 'r01_id']],
            [['r01_destino'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_destino' => 'r01_id']],
            [['c01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ganaderos::className(), 'targetAttribute' => ['c01_id' => 'c01_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p11_id' => 'ID Solicitud',
            'p11_guia' => 'Guia de transito',
            'p11_fecha' => 'Fecha',
            'r01_origen' => 'Unidad Destino',
            'r01_destino' => 'Unidad Origen',
            'c01_id' => 'Productor de la unidad',
            'p11_motivo' => 'Motivo',
            'p11_especie' => 'Especie',
            'p11_aux' => 'Número de cabezas',
            'p11_usuAlta' => 'Solicitante',
            'p11_fecAlta' => 'Fecha de Alta',
            'p11_usuMod' => 'Usuario de Modificacion',
            'p11_fecMod' => 'Fecha de Modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR01Origen()
    {
        return $this->hasOne(R01Upp::className(), ['r01_id' => 'r01_origen']);
    }
    public static function getAretesSolicitud($p12){
        $aretes = ExportacionAretes::find()
            ->Where('p11_id=:id', [':id'=>$p12]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    public static function getAretesNo(){
        $aretes = ExportacionAretes::find()
            ->where('r28_usuAlta=:usr', [':usr'=>Yii::$app->user->getId()])
            ->andWhere('p11_id is null');

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
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
    public function getC01()
    {
        return $this->hasOne(C01Ganaderos::className(), ['c01_id' => 'c01_id']);
    }
}
