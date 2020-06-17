<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "c15_zonas".
 *
 * @property integer $c15_id
 * @property string $c15_descripcion
 */
class Zonas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c15_zonas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c15_id'], 'integer'],
            [['c15_descripcion'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c15_id' => 'C15 ID',
            'c15_descripcion' => 'C15 Descripcion',
        ];
    }

    public static function getAllZonas() {
        $opciones = Zonas::find()->all();
        return ArrayHelper::map($opciones, 'c15_id', 'c15_descripcion');
    }

}
