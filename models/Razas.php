<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c06_raza".
 *
 * @property string $c06_id
 * @property string $c06_raza
 * @property string $c06_especie
 * @property string $c06_clave
 */
class Razas extends \yii\db\ActiveRecord
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
            [['c06_raza', 'c06_clave', 'c06_especie'], 'required'],
            [['c06_raza'], 'string', 'max' => 100],
            [['c06_clave'], 'string', 'max' => 5],
            [['c06_clave'], 'unique', 'targetAttribute'=>['c06_clave', 'c06_especie']],
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
            'c06_raza' => 'Raza',
            'c06_especie' => 'Especie',
            'c06_clave' => 'Clave',
            'c06_activo' => 'Activo',
        ];
    }
    public static function getAllRazas($especie) {
        $dropciones = Razas::find()->where("c06_clave != ''")
            ->where('c06_activo=:activo', [':activo'=>'1'])
            ->andWhere('c06_especie=:esp', [':esp'=>$especie])
            ->asArray()->orderBy('c06_clave')
            ->all();
        return ArrayHelper::map($dropciones, 'c06_id', 'c06_clave');
    }
    public static function getAllRazasSinEsp() {
        $dropciones = Razas::find()->where("c06_clave != ''")
            ->where('c06_activo=:activo', [':activo'=>'1'])
            ->asArray()->orderBy('c06_clave')
            ->all();
        return ArrayHelper::map($dropciones, 'c06_id', 'c06_clave');
    }
}
