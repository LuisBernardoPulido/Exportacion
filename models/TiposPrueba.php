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
class TiposPrueba extends \yii\db\ActiveRecord
{
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
            'c08_id' => 'ID Registro',
            'c08_descripcion' => 'Descripcion',
            'c08_tipo' => 'Tipo',
            'c08_candado' => 'Candado',
        ];
    }

}

