<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "p06_reemo_aretes".
 *
 * @property integer $p06_id
 * @property integer $p04_id
 * @property integer $r02_id
 * @property string $r02_numero
 * @property string $r02_edad
 * @property string $r02_raza
 * @property string $r02_raza2
 * @property string $r02_sexo
 * @property integer $p06_usuAlta
 * @property string $p06_fecAlta
 */
class ReemoAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p06_reemo_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p06_id', 'p04_id', 'r02_id', 'p06_usuAlta'], 'integer'],
            [['p06_fecAlta'], 'safe'],
            [['r02_numero', 'r02_edad', 'r02_raza', 'r02_raza2', 'r02_sexo'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p06_id' => 'P06 ID',
            'p04_id' => 'P04 ID',
            'r02_id' => 'R02 ID',
            'r02_numero' => 'R02 Numero',
            'r02_edad' => 'R02 Edad',
            'r02_raza' => 'R02 Raza',
            'r02_raza2' => 'R02 Raza2',
            'r02_sexo' => 'R02 Sexo',
            'p06_usuAlta' => 'P06 Usu Alta',
            'p06_fecAlta' => 'P06 Fec Alta',
        ];
    }

    public static function getAretesReemo(){
        $aretes = ReemoAretes::find()
            ->where('p04_id=0')
            ->andWhere('p06_usuAlta=:user',[':user'=>Yii::$app->user->getId()]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    public static function getAretesPorReemo($idReemo){
        $aretes = ReemoAretes::find()
            ->where('p04_id=:id', [':id'=>$idReemo]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
