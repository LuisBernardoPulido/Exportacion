<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r26_garrapatas_aretes".
 *
 * @property integer $r26_id
 * @property integer $p03_gr
 * @property integer $r02_id
 * @property integer $r26_ordenar
 * @property integer $r26_ordenar_comp
 * @property integer $r26_usuAlta
 * @property string $r26_fecAlta
 * @property integer $r26_usuMod
 * @property string $r26_fecMod
 */
class GarrapatasAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r26_garrapatas_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p03_gr', 'r02_id', 'r26_ordenar', 'r26_ordenar_comp', 'r26_usuAlta', 'r26_usuMod'], 'integer'],
            [['r02_id'], 'required'],
            [['r26_fecAlta', 'r26_fecMod'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r26_id' => 'ID Registro',
            'p03_gr' => 'ID Prueba',
            'r02_id' => 'ID Arete',
            'r26_ordenar' => 'Ordenar',
            'r26_ordenar_comp' => 'Ordenar Complementaria',
            'r26_usuAlta' => 'Usuario Alta',
            'r26_fecAlta' => 'Fecha Alta',
            'r26_usuMod' => 'Usuario Modifica',
            'r26_fecMod' => 'Fecha Modifica',
        ];
    }

    public static function generarAretes($prueba, $id, $motivo){

        //es motivo de exportación
        if($motivo==116){
            $aretesSeleccion = SeleccionPreviaAretes::find()
                ->where('p02_id=:id', [':id'=>$prueba->p02_id])
                ->andWhere('r05_gr=:num',[':num'=>1])
                ->innerJoinWith('r02 a')
                ->orderBy('a.r02_arete_azul')->all();
        }else{
            $aretesSeleccion = SeleccionPreviaAretes::find()
                ->where('p02_id=:id', [':id'=>$prueba->p02_id])
                ->andWhere('r05_gr=:num',[':num'=>1])
                ->innerJoinWith('r02 a')
                ->orderBy('a.r02_numero')->all();
        }

        $contador_caratula_count=0;
        $bandera_complementaria=0;
        $contador_complementaria_count=0;

        foreach ($aretesSeleccion as $arete){
            //$esp_aux = Aretes::findOne($arete->r02_id);
            $nuevo = new GarrapatasAretes();
            $nuevo->p03_gr= $id;
            $nuevo->r02_id = $arete->r02_id;
            $nuevo->r26_usuAlta = Yii::$app->user->getId();
            $nuevo->r26_fecAlta = Utileria::horaFechaActual();

            if($contador_caratula_count<50){
                if($contador_caratula_count<25)
                    $bandera_caraturla=0;
                else
                    $bandera_caraturla=1;

                $nuevo->r26_ordenar=$bandera_caraturla;
                $contador_caratula_count++;
            }else{
                if($contador_complementaria_count>=69){
                    $contador_complementaria_count=0;
                }else if($contador_complementaria_count<69){
                    if($contador_complementaria_count<35)
                        $bandera_complementaria = 0;
                    else
                        $bandera_complementaria=1;

                }
                $nuevo->r26_ordenar_comp=$bandera_complementaria;
                $contador_complementaria_count++;
            }
            $nuevo->save();
        }
    }
}
