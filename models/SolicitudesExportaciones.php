<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "p12_exportaciones".
 *
 * @property integer $p12_id
 * @property integer $p12_sexo
 * @property string $p12_aux
 * @property string $p12_aux2
 * @property integer $p12_usuAlta
 * @property string $p12_fecAlta
 * @property integer $p12_usuMod
 * @property string $p12_fecMod
 */
class SolicitudesExportaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p12_exportaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p12_sexo', 'p12_usuAlta', 'p12_usuMod'], 'integer'],
            [['p12_fecAlta', 'p12_fecMod'], 'safe'],
            [['p12_aux', 'p12_aux2'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p12_id' => 'ID',
            'p12_sexo' => 'Sexo de animales a exportar',
            'p12_aux' => 'Estatus',
            'p12_aux2' => 'Campo auxiliar 2',
            'p12_usuAlta' => 'Usuario de Alta',
            'p12_fecAlta' => 'Fecha de Alta',
            'p12_usuMod' => 'Usuario de modificacion',
            'p12_fecMod' => 'Fecha de Modificacion',
        ];
    }
    public static function getAretesSolicitud($p12){
        $aretes = SolicitudesExportacionesAretes::find()
            ->Where('p12_id=:id', [':id'=>$p12]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    public static function getAretesNo(){
        $aretes = SolicitudesExportacionesAretes::find()
            ->where('r29_usuAlta=:usr', [':usr'=>Yii::$app->user->getId()])
            ->andWhere('p12_id is null');

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
