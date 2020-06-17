<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c13_tiporesultados".
 *
 * @property integer $c13_id
 * @property string $c13_descrip
 * @property string $c13_descrip2
 * @property string $c13_tipo
 */
class Resultados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c13_tiporesultados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c13_descrip'], 'required'],
            [['c13_tipo', 'c13_activo'], 'string'],
            [['c13_descrip', 'c13_descrip2'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c13_id' => 'ID Resultado',
            'c13_descrip' => 'Descripción',
            'c13_descrip2' => 'Descripción Auxiliar',
            'c13_tipo' => '0:BR, 1:TB, 2:VC',
            'c13_activo' => 'Activo',
        ];
    }
    public static function getResultadoTipo($tipo) {
        $dropciones = Resultados::find()->where('c13_tipo=:tipo', [':tipo'=>strval($tipo)])->andWhere('c13_activo="1"')->all();
        return ArrayHelper::map($dropciones, 'c13_id', 'c13_descrip');
    }
    public static function getResultadoTipoSinE($tipo) {
        $dropciones = Resultados::find()
            ->where('c13_tipo=:tipo', [':tipo'=>strval($tipo)])
            ->andWhere('c13_activo="1"')
            ->andWhere('c13_descrip!=\'e\'')
            ->all();
        return ArrayHelper::map($dropciones, 'c13_id', 'c13_descrip');
    }

}
