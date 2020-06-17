<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c11_especies".
 *
 * @property integer $c11_id
 * @property string $c11_descrip
 * @property string $c11_descrip2
 * @property integer $c11_activo
 */
class Especies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c11_especies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c11_descrip'], 'required'],
            [['c11_activo'], 'integer'],
            [['c11_descrip', 'c11_descrip2'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c11_id' => 'ID Especie',
            'c11_descrip' => 'Descripción',
            'c11_descrip2' => 'Descripción 2',
            'c11_activo' => 'Estatus',
        ];
    }

    public static function getAllEspecies() {
        $lista = Especies::find()

            ->all();
        return ArrayHelper::map($lista, 'c11_id', function($model, $defaultValue) {
            return $model['c11_descrip'];
        });
    }
}
