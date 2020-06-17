<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "c07_motivo_prueba".
 *
 * @property string $c07_id
 * @property string $c07_descripcion
 * @property integer $c07_tipo
 * @property integer $c07_candado
 *
 * @property P03Br[] $p03Brs
 * @property P03Tb[] $p03Tbs
 */
class MotivosPrueba extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c07_motivo_prueba';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c07_descripcion'], 'required'],
            [['c07_tipo', 'c07_candado'], 'integer'],
            [['c07_descripcion'], 'unique', 'targetAttribute'=>['c07_descripcion', 'c07_tipo']],
            [['c07_descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c07_id' => 'ID',
            'c07_descripcion' => 'Descripcion',
            'c07_tipo' => 'Tipo',
            'c07_candado' => 'Variable Privada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03Brs()
    {
        return $this->hasMany(Brucelosis::className(), ['p03_motivoPrueba' => 'c07_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03Tbs()
    {
        return $this->hasMany(Tuberculosis::className(), ['p03_motivoPrueba' => 'c07_id']);
    }
}
