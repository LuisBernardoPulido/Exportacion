<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r02_aretes".
 *
 * @property integer $r02_id
 * @property string $r02_numero
 * @property string $r02_edad
 * @property string $r02_raza
 * @property string $r02_raza2
 * @property string $r02_sexo
 * @property string $r02_fierro
 * @property string $r02_fnacimiento
 * @property integer $r02_especie
 * @property string $Empadre
 * @property integer $r02_mostrar
 * @property integer $p01_id
 * @property integer $p01_isfechadefinitiva
 * @property integer $p01_upp_anterior
 * @property string $r02_edad_ant
 * @property string $r02_raza_ant
 * @property string $r02_raza2_ant
 * @property string $r02_sexo_ant
 * @property integer $r02_especie_ant
 * @property integer $r02_usuAlta
 * @property string $r02_fecAlta
 * @property integer $r02_usuMod
 * @property string $r02_fecMod
 *
 * @property R03DictamenAretes[] $r03DictamenAretes
 */
class Aretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r02_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['r02_numero', 'r02_edad', 'r02_raza', 'r02_sexo', 'r02_fnacimiento', 'r02_fecAlta', 'r02_especie', 'r02_usuAlta', 'p01_isfechadefinitiva'], 'required'],
            //[['r02_numero', 'r02_edad', 'r02_raza', 'r02_sexo' ], 'required'],
            [['r02_fnacimiento', 'r02_fecAlta', 'r02_fecMod','r02_fechaPendiente'], 'safe'],//'r02_arete_azul'
            [['r02_mostrar', 'p01_isfechadefinitiva', 'p01_upp_anterior', 'r02_especie_ant', 'r02_usuAlta', 'r02_especie', 'p01_id', 'r02_usuMod'], 'integer'],
            [['r02_numero', 'r02_edad', 'r02_raza', 'r02_raza2', 'r02_sexo', 'r02_fierro', 'Empadre', 'r02_edad_ant', 'r02_raza_ant', 'r02_raza2_ant', 'r02_sexo_ant'], 'string', 'max' => 50],
            //[['r02_numero'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r02_id' => 'R02 ID',
            'r02_numero' => 'Número de Arete',
            'r02_edad' => 'Edad',
            'r02_raza' => 'Raza',
            'r02_raza2' => 'Raza de Cruza',
            'r02_sexo' => 'Sexo',
            'r02_fierro' => 'Fierro',
            'r02_fnacimiento' => 'Fecha de nacimiento',
            'r02_especie' => 'Especie',
            'Empadre' => 'Empadre',
            'r02_mostrar' => 'Estatus',
            'p01_id' => 'ID Reseña',
            'p01_isfechadefinitiva' => 'Fecha Definitiva',
            'p01_upp_anterior' => 'UPP Anterior Auxiliar',
            'r02_edad_ant' => 'Edad Anterior',
            'r02_raza_ant' => 'Raza Anterior',
            'r02_raza2_ant' => 'Raza de Cruza Anterior',
            'r02_sexo_ant' => 'Sexo Anterior',
            'r02_especie_ant' => 'Especie Anterior',
            'r02_usuAlta' => 'Usuario Alta',
            'r02_fecAlta' => 'Fecha Alta',
            'r02_usuMod' => 'Usuario Modificación',
            'r02_fecMod' => 'Fecha Modificación',
            'r02_fechaPendiente' => 'Fecha pendiente',
            //'r02_arete_azul' => 'Arete Azul',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR03DictamenAretes()
    {
        return $this->hasMany(R03DictamenAretes::className(), ['r02_id' => 'r02_id']);
    }
    public static function getAretes() {
        $aretes = Aretes::find()
            ->where('r02_mostrar=:activo',[':activo'=>0]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getAretes2() {
        $aretes = Aretes::find()
            ->where('r02_mostrar=:activo',[':activo'=>1]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    public static function getAretesNo($especie){
        $aretes = Aretes::find()
            ->where('r01_id=:numero', [':numero'=>0])
            ->andWhere('r02_usuAlta=:user',[':user'=>Yii::$app->user->getId()])
            ->andWhere('r02_especie=:especie',[':especie'=>$especie])
            ->andWhere('r02_mostrar!=-1');

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    public static function getAretesPorUpp($id, $idResena){
        $aretes = Aretes::find()
            ->where('r01_id=:id', [':id'=>$id])
            ->andWhere('p01_id=:idresena', [':idresena'=>$idResena])->andWhere('r02_mostrar!=-1');

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getAretesPorUppOnly($id){
        $aretes = Aretes::find()
            ->where('r01_id=:id', [':id'=>$id])
            ->andWhere('r02_mostrar!=-1');

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getOnlyArete($id){
        $aretes = Aretes::find()
            ->where('r02_numero=:id', [':id'=>$id]);


        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
