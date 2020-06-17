<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c09_funcion_zoo".
 *
 * @property integer $c09_id
 * @property string $c09_descrip
 * @property string $c09_descrip2
 */
class FuncionesZoo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c09_funcion_zoo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c09_descrip'], 'required'],
            [['c09_descrip', 'c09_descrip2'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c09_id' => 'ID Zootécnica',
            'c09_descrip' => 'Descripción',
            'c09_descrip2' => 'Segunda descripción',
        ];
    }
    public static function getAllFunciones() {
        $dropciones = FuncionesZoo::find()

            ->all();
        return ArrayHelper::map($dropciones, 'c09_id', 'c09_descrip');
    }
}
