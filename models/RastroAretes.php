<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "r14_rastro_aretes".
 *
 * @property integer $r14_id
 * @property integer $p08_id
 * @property integer $r02_id
 * @property string $r02_numero
 * @property string $r02_edad
 * @property string $r02_raza
 * @property string $r02_raza2
 * @property string $r02_sexo
 * @property integer $r14_usuAlta
 * @property string $r14_fecAlta
 */
class RastroAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r14_rastro_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p08_id', 'r02_id', 'r14_usuAlta'], 'integer'],
            [['r14_fecAlta'], 'safe'],
            [['r02_numero', 'r02_edad', 'r02_raza', 'r02_raza2', 'r02_sexo'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r14_id' => 'R14 ID',
            'p08_id' => 'P08 ID',
            'r02_id' => 'R02 ID',
            'r02_numero' => 'R02 Numero',
            'r02_edad' => 'R02 Edad',
            'r02_raza' => 'R02 Raza',
            'r02_raza2' => 'R02 Raza2',
            'r02_sexo' => 'R02 Sexo',
            'r14_usuAlta' => 'R14 Usu Alta',
            'r14_fecAlta' => 'R14 Fec Alta',
        ];
    }

    public static function getAretesRastro(){
        $aretes = RastroAretes::find()
            ->where('p08_id=0')
            ->andWhere('r14_usuAlta=:user',[':user'=>Yii::$app->user->getId()]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
