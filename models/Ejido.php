<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c19_ejido".
 *
 * @property integer $c19_id
 * @property string $c19_nombre
 * @property string $c19_estatus
 */
class Ejido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c19_ejido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c19_nombre', 'c19_estatus'], 'required'],
            [['c19_estatus'], 'string'],
            [['c19_nombre'], 'unique'],
            [['c19_nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c19_id' => 'ID',
            'c19_nombre' => 'Nombre',
            'c19_estatus' => 'Estatus',
        ];
    }

    public static function getAllEjidos() {
        $dropciones = Ejido::find()
            ->where("c19_estatus=1 ")
            ->asArray()
            ->all();

        foreach ($dropciones as $d){

        }
        return ArrayHelper::map($dropciones, 'c19_id', function($model, $defaultValue) {
            return strtoupper($model['c19_nombre']);
        });
    }
}
