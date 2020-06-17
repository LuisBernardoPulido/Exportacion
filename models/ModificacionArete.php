<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r22_modificacion_arete".
 *
 * @property integer $r22_id
 * @property integer $r22_usuario_modifica
 * @property integer $r02_id
 * @property string $r02_numero_anterior
 * @property string $r02_edad_anterior
 * @property string $r02_raza_anterior
 * @property string $r02_raza2_anterior
 * @property string $r02_sexo_anterior
 * @property string $r02_especie_anterior
 * @property string $r02_fnacimiento_anterior
 * @property string $r02_numero_actual
 * @property string $r02_edad_actual
 * @property string $r02_raza_actual
 * @property string $r02_raza2_actual
 * @property string $r02_sexo_actual
 * @property string $r02_especie_actual
 * @property string $r02_fnacimiento_actual
 * @property string $r02_fecAlt
 *
 * @property Users $r22UsuarioModifica
 * @property R02Aretes $r02
 */
class ModificacionArete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r22_modificacion_arete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r22_usuario_modifica', 'r02_id'], 'required'],
            [['r22_usuario_modifica', 'r02_especie_anterior', 'r02_id', 'r02_especie_actual', 'r02_isfechadefinitiva_ant', 'r02_isfechadefinitiva_act', 'r02_mostrar_anterior', 'r02_mostrar_actual'], 'integer'],
            //[['r22_usuario_modifica', 'r02_especie_anterior', 'r02_id', 'r02_especie_actual'], 'integer'],
            [['r02_fnacimiento_anterior', 'r02_fnacimiento_actual', 'r02_fecAlt'], 'safe'],
            [['r02_numero_anterior', 'r02_edad_anterior', 'r02_raza_anterior', 'r02_raza2_anterior', 'r02_sexo_anterior',  'r02_numero_actual', 'r02_edad_actual', 'r02_raza_actual', 'r02_raza2_actual', 'r02_sexo_actual'], 'string', 'max' => 50],
            //[['r22_usuario_modifica'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['r22_usuario_modifica' => 'id']],
            [['r02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aretes::className(), 'targetAttribute' => ['r02_id' => 'r02_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r22_id' => 'ID',
            'r22_usuario_modifica' => 'Usuario que Modificó',
            'r02_id' => 'ID del Arete',
            'r02_numero_anterior' => 'Número de Arete',
            'r02_edad_anterior' => 'Edad Anterior',
            'r02_raza_anterior' => 'Raza Anterior',
            'r02_raza2_anterior' => 'Raza Cruza Anterior',
            'r02_sexo_anterior' => 'Sexo Anterior',
            'r02_especie_anterior' => 'Especie Anterior',
            'r02_fnacimiento_anterior' => 'Fecha de nacimiento Anterior',
            'r02_numero_actual' => 'Numero Actual',
            'r02_edad_actual' => 'Edad Actual',
            'r02_raza_actual' => 'Raza Actual',
            'r02_raza2_actual' => 'Raza Cruza Actual',
            'r02_sexo_actual' => 'Sexo Actual',
            'r02_especie_actual' => 'Especie Actual',
            'r02_fnacimiento_actual' => 'Fecha de nacimiento Actual',
            'r02_fecAlt' => 'Fecha Modificación',
            'r02_isfechadefinitiva_act' => 'Fecha Definitiva Actual',
            'r02_isfechadefinitiva_ant' => 'Fecha Definitiva Anterior',

            'r02_mostrar_actual' => 'Mostrar Actual',
            'r02_mostrar_anterior' => 'Mostrar Anterior',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR22UsuarioModifica()
    {
        return $this->hasOne(Users::className(), ['id' => 'r22_usuario_modifica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR02()
    {
        return $this->hasOne(   Aretes::className(), ['r02_id' => 'r02_id']);
    }
}
