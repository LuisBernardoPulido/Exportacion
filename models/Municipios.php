<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c03_municipios".
 *
 * @property integer $c03_id
 * @property integer $c03_cve_mun
 * @property integer $c03_cve_ent
 * @property string $c03_nom_mun
 *
 * @property C02Estados $c03CveEnt
 */
class Municipios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c03_municipios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c03_cve_mun', 'c03_cve_ent', 'c03_nom_mun'], 'required'],
            [['c03_cve_mun', 'c03_cve_ent'], 'integer'],
            [['c03_nom_mun'], 'string', 'max' => 255],
            [['c03_cve_ent'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['c03_cve_ent' => 'c02_cve_ent']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c03_id' => 'C03 ID',
            'c03_cve_mun' => 'ID Municipio',
            'c03_cve_ent' => 'ID Estado',
            'c03_nom_mun' => 'Nombre municipio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC03CveEnt()
    {
        return $this->hasOne(C02Estados::className(), ['c02_cve_ent' => 'c03_cve_ent']);
    }

    public static function getAllMunicipios($estado) {
        $lista = Municipios::find() -> where('c03_cve_ent=:estado',[':estado'=>$estado])

            ->all();
        return ArrayHelper::map($lista, 'c03_id', function($model, $defaultValue) {
            return $model['c02_nom_mun'];
        });
    }
    public static function getAllMuns() {
        $lista = Municipios::find()

            ->all();
        return ArrayHelper::map($lista, 'c03_id', function($model, $defaultValue) {
            return $model['c03_nom_mun'];
        });
    }

    public static  function getMunicipiosPorEdo($id){
        $op = Municipios::find()->where('c03_cve_ent=:id', ['id'=>$id])->all();

        return ArrayHelper::map($op, 'c03_id', 'c03_nom_mun');
    }

    public static  function getMunicipiosPorEdoOrdenados($id){
        $op = Municipios::find()
            ->where('c03_cve_ent=:id', ['id'=>$id])
            ->orderBy('c03_nom_mun')
            ->all();

        return ArrayHelper::map($op, 'c03_id', 'c03_nom_mun');
    }


}
