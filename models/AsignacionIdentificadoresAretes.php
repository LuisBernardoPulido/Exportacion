<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r24_asignacion_identificadores_aretes".
 *
 * @property integer $r24_id
 * @property integer $r23_id
 * @property string $r24_numero_arete
 * @property string $r24_especie
 * @property string $r24_edad
 * @property string $r24_raza
 * @property string $r24_raza2
 * @property string $r24_sexo
 * @property string $r24_fnacimiento
 * @property integer $r24_usuAlta
 * @property string $r24_fecAlta
 *
 * @property R23AsignacionIdentificadores $r23
 */
class AsignacionIdentificadoresAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r24_asignacion_identificadores_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r23_id', 'r24_numero_arete', 'r24_especie'], 'required'],
            [['r23_id', 'r24_usuAlta'], 'integer'],
            //[['r24_fnacimiento', 'r24_fecAlta'], 'safe'],
            [['r24_numero_arete', 'r24_especie', 'r24_edad', 'r24_raza', 'r24_raza2', 'r24_sexo'], 'string', 'max' => 50],
            //[['r23_id'], 'exist', 'skipOnError' => true, 'targetClass' => R23AsignacionIdentificadores::className(), 'targetAttribute' => ['r23_id' => 'r23_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r24_id' => 'R24 ID',
            'r23_id' => 'R23 ID',
            'r24_numero_arete' => 'R24 Numero Arete',
            'r24_especie' => 'R24 Especie',
            'r24_edad' => 'R24 Edad',
            'r24_raza' => 'R24 Raza',
            'r24_raza2' => 'R24 Raza2',
            'r24_sexo' => 'R24 Sexo',
            'r24_fnacimiento' => 'R24 Fnacimiento',
            'r24_usuAlta' => 'R24 Usu Alta',
            'r24_fecAlta' => 'R24 Fec Alta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR23()
    {
        return $this->hasOne(R23AsignacionIdentificadores::className(), ['r23_id' => 'r23_id']);
    }
}
