<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "c02_estados".
 *
 * @property integer $c02_cve_ent
 * @property string $c02_nom_abr
 * @property string $c02_nom_ent
 *
 * @property C03Municipios[] $c03Municipios
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c02_estados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c02_cve_ent'], 'required'],
            [['c02_cve_ent'], 'integer'],
            [['c02_nom_abr', 'c02_nom_ent'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c02_cve_ent' => 'C02 Cve Ent',
            'c02_nom_abr' => 'Nombre',
            'c02_nom_ent' => 'Abreviación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC03Municipios()
    {
        return $this->hasMany(C03Municipios::className(), ['c03_cve_ent' => 'c02_cve_ent']);
    }

    public static function getAllEstados() {
        $lista = Estados::find()

            ->all();

        return ArrayHelper::map($lista, 'c02_cve_ent', function($model, $defaultValue) {
            return $model['c02_nom_ent'];
        });
    }
}
