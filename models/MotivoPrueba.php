<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c07_motivo_prueba".
 *
 * @property string $c07_id
 * @property string $c07_descripcion
 * @property integer $c07_tipo
 * @property integer $c07_candado
 *
 * @property P03Br[] $p03Brs
 * @property P03Tb[] $p03Tbs
 */
class MotivoPrueba extends \yii\db\ActiveRecord
{

    const TUBERCULOSIS =0;
    const BRUCELOSIS =1;
    const VACUNACION =2;
    const OTRO = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c07_motivo_prueba';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c07_descripcion'], 'required'],
            [['c07_tipo', 'c07_candado'], 'integer'],
            [['c07_descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c07_id' => 'C07 ID',
            'c07_descripcion' => 'C07 Descripcion',
            'c07_tipo' => 'C07 Tipo',
            'c07_candado' => 'Variable Privada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03Brs()
    {
        return $this->hasMany(Brucelosis::className(), ['p03_motivoPrueba' => 'c07_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03Tbs()
    {
        return $this->hasMany(Tuberculosis::className(), ['p03_motivoPrueba' => 'c07_id']);
    }

    public static function getAllMotivos()
    {
        $dropciones = MotivoPrueba::find()
            ->all();
        return ArrayHelper::map($dropciones, 'c07_id', 'c07_descripcion');
    }

    public static function getMotivosPorTipo($tipo)
    {
        $dropciones = MotivoPrueba::find()->where('c07_tipo=:tipo', [':tipo'=>$tipo])
            ->andWhere('c07_candado=1')
            ->orWhere('c07_tipo=:otro', [':otro'=>self::OTRO])
            ->all();

        return ArrayHelper::map($dropciones, 'c07_id', 'c07_descripcion');
    }

    public static function getMotivosTbPrueba($tipo)
    {
        //Casi todos los motivos
        if($tipo==0){
            $dropciones = MotivoPrueba::find()->where('c07_tipo=0')
                ->andWhere('c07_candado=1')
                ->andWhere('c07_id!=17')
                ->andWhere('c07_id!=15')
                ->all();
        }else if($tipo==1){//Movilización
            $dropciones = MotivoPrueba::find()->where('c07_id=17')->all();
        }else if($tipo==2){//Exportación
            $dropciones = MotivoPrueba::find()->where('c07_id=15')->all();
        }


        return ArrayHelper::map($dropciones, 'c07_id', 'c07_descripcion');
    }

    public static function getMotivosBRPrueba($tipo)
    {
        //Casi todos los motivos
        if($tipo==0 || $tipo==1){
            $dropciones = MotivoPrueba::find()->where('c07_tipo=1')
                ->andWhere('c07_candado=1')
                ->andWhere('c07_id!=11')
                //->andWhere('c07_id!=12')
                ->all();
        }
        /*else if($tipo==1){
            $dropciones = MotivoPrueba::find()->where('c07_id=12')->all();
        }*/
        else if($tipo==2){//Exportación
            $dropciones = MotivoPrueba::find()->where('c07_id=11')->all();
        }


        return ArrayHelper::map($dropciones, 'c07_id', 'c07_descripcion');
    }

    public static function getMotivosGrPrueba($tipo){
        //Casi todos los motivos
        if($tipo==0 || $tipo==1){
            $dropciones = MotivoPrueba::find()->where('c07_tipo=3')
                ->andWhere('c07_candado=1')
                ->andWhere('c07_id!=116')
                //->andWhere('c07_id!=12')
                ->all();
        }else if($tipo==2){//Exportación
            $dropciones = MotivoPrueba::find()->where('c07_id=116')->all();
        }


        return ArrayHelper::map($dropciones, 'c07_id', 'c07_descripcion');
    }

    public static function getAllMotivosGrPrueba(){
        //todos los motivos

        $dropciones = MotivoPrueba::find()->where('c07_tipo=3')
            ->andWhere('c07_candado=1')
            ->all();


        return ArrayHelper::map($dropciones, 'c07_id', 'c07_descripcion');
    }

    public function getMotivo($id){
        $sql = 'select * from c07_motivo_prueba where c07_id='.$id;

        $motivo = MotivoPrueba::findBySql($sql)->all();

        return implode("|",$motivo->c07_descripcion);

    }
}


