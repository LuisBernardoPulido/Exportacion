<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c12_tipomuestras".
 *
 * @property integer $c12_id
 * @property string $c12_descrip
 * @property string $c12_descrip2
 */
class Muestras extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c12_tipomuestras';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c12_descrip'], 'required'],
            [['c12_descrip', 'c12_descrip2'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c12_id' => 'ID Tipo de Muestras',
            'c12_descrip' => 'Descripción',
            'c12_descrip2' => 'Descripción Auxiliar',
        ];
    }
    public static function getAllMuestras() {
        $dropciones = Muestras::find()

            ->all();
        return ArrayHelper::map($dropciones, 'c12_id', 'c12_descrip');
    }
}
