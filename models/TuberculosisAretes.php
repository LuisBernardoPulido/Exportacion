<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r06_tuberculosis_aretes".
 *
 * @property integer $r06_id
 * @property integer $p03_tb
 * @property integer $r02_id
 * @property integer $r06_diagnostico
 * @property string $r06_uno
 * @property string $r06_frealizacion
 * @property integer $r06_ordenar_dictamen
 * @property integer $r06_usuAlta
 * @property string $r06_fecAlta
 * @property integer $r06_usuMod
 * @property string $r06_fecMod
 *
 * @property P03Tb $p03Tb
 * @property R02Aretes $r02
 * @property C13Tiporesultados $r06Diagnostico
 */
class TuberculosisAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const NEGATIVO =4;
    const SOSPECHOSO =5;
    const REACTIVO = 6;
    const ASTERISCO =7;
    const SIN_LECTURA =16;

    public static function tableName()
    {
        return 'r06_tuberculosis_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p03_tb', 'r02_id', 'r06_diagnostico', 'r06_ordenar_dictamen', 'r06_usuAlta', 'r06_usuMod'], 'integer'],
            [['r06_frealizacion', 'r06_fecAlta', 'r06_fecMod'], 'safe'],
            [['r06_uno'], 'string', 'max' => 10],
            [['p03_tb'], 'exist', 'skipOnError' => true, 'targetClass' => Tuberculosis::className(), 'targetAttribute' => ['p03_tb' => 'p03_id']],
            [['r02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aretes::className(), 'targetAttribute' => ['r02_id' => 'r02_id']],
            [['r06_diagnostico'], 'exist', 'skipOnError' => true, 'targetClass' => Resultados::className(), 'targetAttribute' => ['r06_diagnostico' => 'c13_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r06_id' => 'ID Registro',
            'p03_tb' => 'Dictamen TB',
            'r02_id' => 'ID Arete',
            'r06_diagnostico' => 'Diagnostico',
            'r06_uno' => 'UNO',
            'r06_frealizacion' => 'Fecha de realización',
            'r06_ordenar_dictamen' => 'Ordenar Dictamen TB',
            'r06_usuAlta' => 'Usuario Alta',
            'r06_fecAlta' => 'Fecha de Alta',
            'r06_usuMod' => 'Usuario Modificación',
            'r06_fecMod' => 'Fecha Módificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03Tb()
    {
        return $this->hasOne(Tuberculosis::className(), ['p03_id' => 'p03_tb']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR02()
    {
        return $this->hasOne(Aretes::className(), ['r02_id' => 'r02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR06Diagnostico()
    {
        return $this->hasOne(Resultados::className(), ['c13_id' => 'r06_diagnostico']);
    }
    //Generamos aretes dada una prueba y un dictamen
    public static function generarAretes($prueba, $id){

        $dictamen = Tuberculosis::findOne($id);
        if($dictamen->p03_cc){
            $aretesSeleccion = TuberculosisAretes::findBySql("select * from r06_tuberculosis_aretes where (r06_diagnostico = ".TuberculosisAretes::SOSPECHOSO." or r06_diagnostico = ".TuberculosisAretes::REACTIVO.") and p03_tb=".$dictamen->p03_cc)->joinWith('r02 a')->orderBy('a.r02_numero')->all();
        }else{
            $aretesSeleccion = SeleccionPreviaAretes::find()->where('p02_id=:id', [':id'=>$prueba->p02_id])->andWhere('r05_tb=:num',[':num'=>1])->joinWith('r02 a')->orderBy('a.r02_numero')->all();
        }

        foreach ($aretesSeleccion as $arete){
            $nuevo = new TuberculosisAretes();
            $nuevo->p03_tb= $id;
            $nuevo->r02_id = $arete->r02_id;
            $nuevo->r06_usuAlta = Yii::$app->user->getId();
            $nuevo->save();
        }

    }

    //Regresa los aretes asignados por cada dictamen
    public static function getAretesPorDictamenSinResultado(){

        $aretes = TuberculosisAretes::find()
            ->where('r06_diagnostico is NULL')
            ->andWhere('r06_usuAlta=:user', [':user'=>Yii::$app->user->getId()]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    public static function getAretesPorDictamenConResultado($tb){
        $aretes = TuberculosisAretes::find()
            ->where('p03_tb=:tb', [':tb'=>$tb]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
