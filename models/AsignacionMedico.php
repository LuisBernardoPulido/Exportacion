<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r03_medico_upp".
 *
 * @property integer $r03_id
 * @property integer $c05_id
 * @property integer $c01_id
 * @property integer $r01_id
 * @property string $r03_fpruebaant
 * @property string $r03_tipoprueba
 * @property integer $r03_nodictamen
 * @property integer $r03_motivoprueba
 * @property string $r03_finyeccion
 * @property string $r03_flectura
 * @property integer $r03_tipomvz
 * @property string $r03_tipo
 * @property string $r03_fecha
 *
 * @property R03AretesMedicoUpp[] $r03AretesMedicoUpps
 * @property C05Mvz $c05
 * @property C01Ganaderos $c01
 * @property R01Upp $r01
 */
class AsignacionMedico extends \yii\db\ActiveRecord
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
            [['c05_id', 'c01_id', 'r01_id', 'r03_tipoprueba', 'r03_motivoprueba', 'r03_tipomvz', 'r03_fecha'], 'required'],
            [['c05_id', 'c01_id', 'r01_id', 'r03_tipoprueba', 'r03_nodictamen', 'r03_motivoprueba', 'r03_tipomvz'], 'integer'],
            [['r03_fpruebaant', 'r03_finyeccion', 'r03_flectura', 'r03_fecha'], 'safe'],
            [['r03_tipo'], 'string'],
            [['c05_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['c05_id' => 'c05_id']],
            [['c01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ganaderos::className(), 'targetAttribute' => ['c01_id' => 'c01_id']],
            [['r01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_id' => 'r01_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r03_id' => 'ID Asignación',
            'c05_id' => 'Médico Veterinario',
            'c01_id' => 'Productor',
            'r01_id' => 'Unidad de producción',
            'r03_fpruebaant' => 'Fecha de Prueba Anterior',
            'r03_tipoprueba' => 'Tipo de Prueba Realizada',
            'r03_nodictamen' => 'No. Asignación',
            'r03_motivoprueba' => 'Mótivo de la prueba',
            'r03_finyeccion' => 'Fecha de inyección',
            'r03_flectura' => 'Fecha de lectura',
            'r03_tipomvz' => 'Tipo de MVZ',
            'r03_tipo' => 'Prueba', //Tipo de asignación
            'r03_fecha' => 'Fecha de asignación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR03AretesMedicoUpps()
    {
        return $this->hasMany(R03AretesMedicoUpp::className(), ['r03_noasignacion' => 'r03_id']);
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
