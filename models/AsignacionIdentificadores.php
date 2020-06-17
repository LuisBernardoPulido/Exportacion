<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r23_asignacion_identificadores".
 *
 * @property integer $r23_id
 * @property integer $r01_id
 * @property integer $c01_id
 * @property integer $r23_especie
 * @property string $r23_motivo
 * @property string $r23_nombre_recibe
 * @property string $r23_celular
 * @property string $r23_codigo_postal
 * @property string $r23_calle
 * @property string $r23_estado
 * @property string $r23_ciudad
 * @property string $r23_colonia
 * @property string $r23_info_adicional
 * @property integer $r23_usuAlta
 * @property string $r23_fecAlta
 * @property integer $r23_usuMod
 * @property string $r23_FecMod
 *
 * @property R01Upp $r01
 * @property C01Ganaderos $c01
 * @property R24AsignacionIdentificadoresAretes[] $r24AsignacionIdentificadoresAretes
 */
class AsignacionIdentificadores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r23_asignacion_identificadores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r01_id', 'c01_id', 'r23_especie', 'r23_motivo', 'r23_cantidad_solicitada'], 'required'],
            [['r01_id', 'c01_id', 'r23_especie', 'r23_usuAlta', 'r23_usuMod', 'r23_cantidad_solicitada'], 'integer'],
            [['r23_motivo'], 'string'],
            [['r23_fecAlta', 'r23_FecMod'], 'safe'],
            [['r23_nombre_recibe', 'r23_celular', 'r23_codigo_postal', 'r23_estado', 'r23_ciudad', 'r23_colonia', 'r23_info_adicional'], 'string', 'max' => 100],
            [['r23_calle'], 'string', 'max' => 150],
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
            'r23_id' => 'Id Asignación',
            'r01_id' => 'Clave de la unidad',
            'c01_id' => 'Productor',
            'r23_especie' => 'Especie',
            'r23_motivo' => 'Motivo',
            'r23_nombre_recibe' => 'Nombre de quien Recibe',
            'r23_celular' => 'Celular',
            'r23_codigo_postal' => 'Código Postal',
            'r23_calle' => 'Calle',
            'r23_estado' => 'Estado',
            'r23_ciudad' => 'Ciudad',
            'r23_colonia' => 'Colonia',
            'r23_info_adicional' => 'Información Adicional',
            'r23_usuAlta' => 'Usuario Alta',
            'r23_fecAlta' => 'Fecha de  Alta',
            'r23_usuMod' => 'Usuario Modificó',
            'r23_FecMod' => 'Fecha de Modificación',
            'r23_cantidad_solicitada' => 'Cantidad de Aretes Solicitada',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR24AsignacionIdentificadoresAretes()
    {
        return $this->hasMany(AsignacionIdentificadoresAretes::className(), ['r23_id' => 'r23_id']);
    }

    public static function getAretes($id){
        $aretes = AsignacionIdentificadoresAretes::find()
            ->where('r23_id=:id', [':id'=>$id]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
