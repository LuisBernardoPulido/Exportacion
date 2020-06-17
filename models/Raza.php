<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "c06_raza".
 *
 * @property string $c06_id
 * @property string $c06_raza
 * @property string $c06_especie
 */
class Raza extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c06_raza';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c06_raza'], 'required'],
            [['c06_raza', 'c06_especie'], 'string', 'max' => 100],
            [['c06_clave', 'c06_raza'], 'unique'],
            [['c06_activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c06_id' => 'C06 ID',
            'c06_raza' => 'C06 Raza',
            'c06_especie' => 'C06 Especie',
        ];
    }
}
