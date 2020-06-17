<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c17_productos".
 *
 * @property integer $c17_id
 * @property string $c17_nombre
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c17_productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c17_nombre', 'c17_estatus'], 'required'],
            [['c17_estatus'], 'string'],
            [['c17_nombre'], 'string', 'max' => 50],
            [['c17_nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c17_id' => 'ID',
            'c17_nombre' => 'Nombre del Producto',
            'c17_estatus' => 'Estatus',
        ];
    }

    public function getProductos(){
        $sql = 'select * from c17_productos where c17_estatus=2 ';

        $productos = Productos::findBySql($sql)->all();

        return ArrayHelper::map($productos, 'c17_id', function($model, $defaultValue) {
            return strtoupper($model['c17_nombre']);
        });

    }
}
