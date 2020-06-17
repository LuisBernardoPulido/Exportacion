<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;



/**
 * This is the model class for table "c08_tipo_prueba".
 *
 * @property string $c08_id
 * @property string $c08_descripcion
 * @property integer $c08_tipo
 * @property integer $c08_candado
 *
 */
class TipoPrueba extends \yii\db\ActiveRecord
{
    const TUBERCULOSIS =0;
    const BRUCELOSIS =1;
    const VACUNACION =2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c08_tipo_prueba';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c08_descripcion'], 'required'],
            [['c08_tipo', 'c08_candado'], 'integer'],
            [['c08_descripcion'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c08_id' => 'C08 ID',
            'c08_descripcion' => 'C08 Descripcion',
            'c08_tipo' => 'C08 Tipo',
            'c08_candado' => 'C08 Candado',
        ];
    }
    public static function getAllTipos() {
        $dropciones = TipoPrueba::find()

            ->all();
        return ArrayHelper::map($dropciones, 'c08_id', 'c08_descripcion');
    }
    public static function getTiposPorTipo($tipo) {
        $dropciones = TipoPrueba::find()->where('c08_tipo=:tipo', [':tipo'=>$tipo])
            ->orWhere('c08_tipo=:otro', [':otro'=>3])
            ->all();
        return ArrayHelper::map($dropciones, 'c08_id', 'c08_descripcion');
    }
    public static function getTiposPorTipoBR($tipo) {
        $dropciones = TipoPrueba::find()->where('c08_id=:tipo', [':tipo'=>2])
            ->orWhere('c08_tipo=:otro', [':otro'=>3])
            ->all();
        return ArrayHelper::map($dropciones, 'c08_id', 'c08_descripcion');
    }

    public static function getTiposPorTipoTB($tipo) {
        $dropciones = TipoPrueba::find()->where('c08_id=:tipo', [':tipo'=>1])
            ->orWhere('c08_tipo=:otro', [':otro'=>3])
            ->all();
        return ArrayHelper::map($dropciones, 'c08_id', 'c08_descripcion');
    }


}
