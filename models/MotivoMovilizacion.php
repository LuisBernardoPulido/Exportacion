<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c21_motivo_movilizacion".
 *
 * @property int $c21_id Id de Motivo de movilización
 * @property string|null $c21_clave Clave
 * @property string $c21_nombre Nombre del motivo
 * @property string|null $c21_descripcion Descripción del motivo
 * @property int $c21_usuAlta Usuario que da de alta
 * @property int|null $c21_usuMod Usuario que modifica
 * @property string $c21_fecAlta Fecha de alta
 * @property string|null $c21_fecMod Fecha de modificación
 * @property string $c21_estatus Estatus: activo o inactivo
 *
 * @property P09ConfiguracionRequisitos[] $p09ConfiguracionRequisitos
 * @property P12Internacion[] $p12Internacions
 */
class MotivoMovilizacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'c21_motivo_movilizacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c21_nombre', 'c21_usuAlta'], 'required'],
            [['c21_usuAlta', 'c21_usuMod'], 'integer'],
            [['c21_fecAlta', 'c21_fecMod'], 'safe'],
            [['c21_estatus'], 'string'],
            [['c21_clave'], 'string', 'max' => 20],
            [['c21_nombre'], 'string', 'max' => 100],
            [['c21_descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'c21_id' => 'C21 ID',
            'c21_clave' => 'C21 Clave',
            'c21_nombre' => 'C21 Nombre',
            'c21_descripcion' => 'C21 Descripcion',
            'c21_usuAlta' => 'C21 Usu Alta',
            'c21_usuMod' => 'C21 Usu Mod',
            'c21_fecAlta' => 'C21 Fec Alta',
            'c21_fecMod' => 'C21 Fec Mod',
            'c21_estatus' => 'C21 Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP09ConfiguracionRequisitos()
    {
        return $this->hasMany(P09ConfiguracionRequisitos::className(), ['c21_id' => 'c21_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP12Internacions()
    {
        return $this->hasMany(P12Internacion::className(), ['c21_id' => 'c21_id']);
    }

    public static function getAllMotivos() {
        $lista = MotivoMovilizacion::find()->where('c21_estatus=\'1\'')->all();
        return ArrayHelper::map($lista, 'c21_id', function($model, $defaultValue) {
            return $model['c21_nombre'];
        });
    }
}
