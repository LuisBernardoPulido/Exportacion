<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r03_dictamenes".
 *
 * @property integer $r03_id
 * @property integer $c05_id
 * @property integer $c01_id
 * @property integer $r01_id
 * @property string $r03_fpruebaant
 * @property string $r03_tipoprueba
 * @property string $r03_especificaciontipo
 * @property integer $r03_nodictamen
 * @property integer $r03_motivoprueba
 * @property string $r03_especificacionmotivo
 * @property integer $r03_funczootecnica
 * @property string $r03_finyeccion
 * @property string $r03_flectura
 * @property integer $r03_tipomvz
 * @property string $r03_tipo
 * @property string $r03_fecha
 * @property string $r03_br_fmuestreo
 * @property string $r03_br_fproxprueba
 * @property integer $r03_totalhato
 * @property integer $r03_muestrahato
 * @property integer $r03 constHatoNo
 * @property string $r03_consHatoFecha
 * @property string $r03_vigencia
 * @property string $r03_fcreacion
 *
 * @property R03AretesDictamen[] $r03AretesDictamens
 * @property R03DictamenAretes[] $r03DictamenAretes
 * @property C05Mvz $c05
 * @property C01Ganaderos $c01
 * @property R01Upp $r01
 */
class Dictamenes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r03_dictamenes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_id', 'c01_id', 'r01_id', 'r03_tipoprueba', 'r03_motivoprueba', 'r03_tipomvz'], 'required'],
            [['c05_id', 'c01_id', 'r01_id', 'r03_tipoprueba', 'r03_nodictamen', 'r03_motivoprueba', 'r03_funczootecnica', 'r03_tipomvz', 'r03_totalhato', 'r03_muestrahato', 'r03_constHatoNo'], 'integer'],
            [['r03_fpruebaant', 'r03_finyeccion', 'r03_flectura', 'r03_fecha', 'r03_br_fmuestreo', 'r03_br_fproxprueba', 'r03_consHatoFecha', 'r03_vigencia', 'r03_fcreacion'], 'safe'],
            [['r03_tipo'], 'string'],
            [['r03_especificaciontipo', 'r03_especificacionmotivo'], 'string', 'max' => 100],
            [['c05_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['c05_id' => 'c05_id']],
            [['c01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ganaderos::className(), 'targetAttribute' => ['c01_id' => 'c01_id']],
            [['r01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_id' => 'r01_id']],
            [['r03_nodictamen'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r03_id' => 'ID Asignación',
            'c05_id' => 'Médico',
            'c01_id' => 'Productor',
            'r01_id' => 'UPP',
            'r03_fpruebaant' => 'Fecha de Prueba Anterior',
            'r03_tipoprueba' => 'Tipo de Prueba Realizada',
            'r03_especificaciontipo' => 'Especificación Tipo de Prueba',
            'r03_nodictamen' => 'No. de Folio',
            'r03_motivoprueba' => 'Mótivo de la prueba',
            'r03_especificacionmotivo' => 'Especificación de motivo de prueba',
            'r03_funczootecnica' => 'Función zootécnica',
            'r03_finyeccion' => 'Fecha de inyección',
            'r03_flectura' => 'Fecha de lectura',
            'r03_tipomvz' => 'Tipo de MVZ',
            'r03_tipo' => 'Tipo de asignación',
            'r03_fecha' => 'Fecha de prueba',
            'r03_br_fmuestreo' => 'Fecha de muestreo',
            'r03_br_fproxprueba' => 'Fecha de proxima prueba',
            'r03_totalhato' => 'Totalidad del hato',
            'r03_muestrahato' => 'Muestra hato',
            'r03_constHatoNo' => 'Constancia de hato libre Número',
            'r03_consHatoFecha' => 'Constancia de hato libre Fecha',
            'r03_vigencia' => 'Vigencia',
            'r03_fcreacion' => 'Fecha de creación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR03AretesDictamens()
    {
        return $this->hasMany(R03AretesDictamen::className(), ['r03_noasignacion' => 'r03_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR03DictamenAretes()
    {
        return $this->hasMany(DictamenesAretes::className(), ['r03_asignacion' => 'r03_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC05()
    {
        return $this->hasOne(Medicos::className(), ['c05_id' => 'c05_id']);
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
    public function getR01()
    {
        return $this->hasOne(Upp::className(), ['r01_id' => 'r01_id']);
    }
}
