<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c10_tenencias".
 *
 * @property integer $c10_id
 * @property string $c10_descrip
 * @property integer $c10_activo
 * @property integer $c10_flag
 */
class Tenencias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c10_tenencias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c10_descrip'], 'required'],
            [['c10_activo', 'c10_flag'], 'integer'],
            [['c10_descrip'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c10_id' => 'ID Tenencias',
            'c10_descrip' => 'Descripción',
            'c10_activo' => 'Estatus',
            'c10_flag' => 'Auxiliar',
        ];
    }
    public static function getAllTenencias() {
        $dropciones = Tenencias::find()->all();
        return ArrayHelper::map($dropciones, 'c10_id', 'c10_descrip');
    }
}
