<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r03_dictamen_aretes".
 *
 * @property integer $r03_id
 * @property integer $r02_id
 * @property string $r03_tipo
 * @property string $r03_diagnostivo
 * @property string $r03_resultado
 * @property string $r03_frealizacion
 * @property integer $r03_asignacion
 * @property integer $r03_usuAlta
 * @property string $r03_fecAlta
 * @property integer $r03_usuMod
 * @property string $r03_fecMod
 *
 * @property R02Aretes $r02
 * @property R03Dictamenes $r03Asignacion
 */
class DictamenesAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r03_dictamen_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r02_id', 'r03_tipo', 'r03_frealizacion'], 'required'],
            [['r02_id', 'r03_asignacion', 'r03_usuAlta', 'r03_usuMod'], 'integer'],
            [['r03_tipo', 'r03_diagnostivo', 'r03_resultado'], 'string'],
            [['r03_frealizacion', 'r03_fecAlta', 'r03_fecMod'], 'safe'],
            [['r02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aretes::className(), 'targetAttribute' => ['r02_id' => 'r02_id']],
            [['r03_asignacion'], 'exist', 'skipOnError' => true, 'targetClass' => Dictamenes::className(), 'targetAttribute' => ['r03_asignacion' => 'r03_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r03_id' => 'ID Registro',
            'r02_id' => 'Arete',
            'r03_tipo' => 'TIpo de prueba',
            'r03_diagnostivo' => 'Diagnostico',
            'r03_resultado' => 'Resultado',
            'r03_frealizacion' => 'Fecha de realización',
            'r03_asignacion' => 'ID de dictamen',
            'r03_usuAlta' => 'Usuario Alta',
            'r03_fecAlta' => 'Fecha de Alta',
            'r03_usuMod' => 'Usuario Modificación',
            'r03_fecMod' => 'Fecha Módificación',
        ];
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
    public function getR03Asignacion()
    {
        return $this->hasOne(R03Dictamenes::className(), ['r03_id' => 'r03_asignacion']);
    }

    //Función que regresa los aretes nulos existentes en la tabla de relaciones
    public static function getAretesNo(){
        $aretes = DictamenesAretes::find()
            ->where('r03_asignacion is null')->andWhere('r03_usuAlta=:user', [':user'=>Yii::$app->user->getId()]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    //Regresa los aretes asignados por cada dictamen
    public static function getAretesPorDictamen($id){
        $aretes = DictamenesAretes::find()
            ->where('r03_asignacion=:id', [':id'=>$id]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

}
