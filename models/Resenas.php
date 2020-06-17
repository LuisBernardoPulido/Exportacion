<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "p01_resenas".
 *
 * @property integer $p01_id
 * @property integer $p01_medico
 * @property integer $p01_upp
 * @property integer $p01_ganadero
 * @property string $p01_fecharealizacion
 * @property integer $p01_activo
 * @property string $p01_usuarioCreate
 * @property string $p01_fechaCreate
 * @property integer $p01_usuMod
 * @property string $p01_fecMod
 * @property integer $p01_especie
 */
class Resenas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p01_resenas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p01_medico', 'p01_upp', 'p01_ganadero', 'p01_activo', 'p01_usuarioCreate', 'p01_usuMod'], 'integer'],
            [['p01_upp'], 'required'],
            [['p01_fecharealizacion', 'p01_fechaCreate', 'p01_fecMod', 'p01_especie'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p01_id' => 'ID Reseña',
            'p01_medico' => 'Médico asignado',
            'p01_upp' => 'Clave UPP',
            'p01_ganadero' => 'Productor',
            'p01_fecharealizacion' => 'Fecha de Alta',
            'p01_activo' => 'Estatus Reseña',
            'p01_usuarioCreate' => 'Usuario Alta',
            'p01_fechaCreate' => 'Fecha de generación',
            'p01_usuMod' => 'Usuario Modificación',
            'p01_fecMod' => 'Fecha de Modificación',
            'p01_especie' => 'Especie',
        ];
    }

    public static function getResenasUsuario($upp){
        $dropciones = Resenas::find()->where('p01_usuarioCreate=:id ', [':id'=>Yii::$app->user->getId()])
            ->andWhere('p01_upp=:upp',[':upp'=>intval($upp)])->all();
        return ArrayHelper::map($dropciones, 'p01_upp', function($model, $defaultValue) {
            return strtoupper($model['p01_id']);
        });
    }
}
