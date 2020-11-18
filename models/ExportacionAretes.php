<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r28_exportacion_aretes".
 *
 * @property integer $r28_id
 * @property integer $r28_especie
 * @property integer $p11_id
 * @property string $r28_numero
 * @property integer $r02_id
 * @property string $r28_edad
 * @property string $r28_raza
 * @property string $r28_raza2
 * @property string $r28_sexo
 * @property string $r28_tb
 * @property string $r28_br
 * @property string $r28_resultadotb
 * @property string $r28_resultadobr
 * @property string $r28_factura
 * @property string $r28_aux
 * @property integer $r28_usuAlta
 * @property string $r28_fecAlta
 * @property integer $r28_usuMod
 * @property string $r28_fecMod
 *
 * @property P11SolicitudExportacion $p11
 */
class ExportacionAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r28_exportacion_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r28_especie', 'p11_id', 'r28_usuAlta', 'r02_id', 'r28_usuMod'], 'integer'],
            [['r28_numero'], 'required'],
            [['r28_fecAlta', 'r28_fecMod'], 'safe'],
            [['r28_numero', 'r28_edad', 'r28_raza', 'r28_raza2', 'r28_sexo', 'r28_tb', 'r28_br', 'r28_resultadotb', 'r28_resultadobr', 'r28_factura', 'r28_aux'], 'string', 'max' => 50],
            //[['r02_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExportacionAretes::className(), 'targetAttribute' => ['r02_id' => 'r02_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r28_id' => 'ID',
            'r28_especie' => 'ESPECIE',
            'p11_id' => 'Solicitud',
            'r02_id' => 'Arete ID',
            'r28_numero' => 'Numero de arete',
            'r28_edad' => 'Edad',
            'r28_raza' => 'Raza',
            'r28_raza2' => 'Raza2',
            'r28_sexo' => 'Sexo',
            'r28_tb' => 'TB',
            'r28_br' => 'BR',
            'r28_resultadotb' => 'R28 Resultadotb',
            'r28_resultadobr' => 'R28 Resultadobr',
            'r28_factura' => 'Factura',
            'r28_aux' => 'R28 Aux',
            'r28_usuAlta' => 'USUARIO DE ALTA',
            'r28_fecAlta' => 'Fecha de alta',
            'r28_usuMod' => 'Usuario de modificacion',
            'r28_fecMod' => 'Fecha de modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR02()
    {
        return $this->hasOne(R02Aretes::className(), ['r02_id' => 'r02_id']);
    }
}
