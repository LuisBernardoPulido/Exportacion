<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c20_anexo".
 *
 * @property integer $c20_id
 * @property integer $c19_id
 * @property string $c20_nombre
 * @property string $c20_estatus
 */
class Anexo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c20_anexo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c19_id', 'c20_nombre', 'c20_estatus'], 'required'],
            [['c19_id'], 'integer'],
            [['c20_estatus'], 'string'],
            //[['c20_nombre'], 'unique'],
            [['c20_nombre'], 'unique', 'targetAttribute'=>['c20_nombre', 'c19_id']],
            [['c20_nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c20_id' => 'ID',
            'c19_id' => 'Ejidos',
            'c20_nombre' => 'Nombre',
            'c20_estatus' => 'Estatus',
        ];
    }

}
