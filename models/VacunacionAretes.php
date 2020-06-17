<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r11_vacunacion_aretes".
 *
 * @property integer $r11_id
 * @property integer $p03_vc
 * @property integer $r02_id
 * @property integer $r11_isvaca
 * @property integer $r11_ordenar
 * @property integer $r11_ordenar_comp
 * @property integer $r11_usuAlta
 * @property string $r11_fecAlta
 * @property integer $r11_usuMod
 * @property string $r11_fecMod
 *
 * @property P03Vc $p03Vc
 * @property Aretes $r02
 */
class VacunacionAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r11_vacunacion_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p03_vc', 'r02_id', 'r11_isvaca', 'r11_ordenar', 'r11_ordenar_comp', 'r11_usuAlta', 'r11_usuMod'], 'integer'],
            [['r11_fecAlta', 'r11_fecMod'], 'safe'],
            [['p03_vc'], 'exist', 'skipOnError' => true, 'targetClass' => Vacunacion::className(), 'targetAttribute' => ['p03_vc' => 'p03_id']],
            [['r02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aretes::className(), 'targetAttribute' => ['r02_id' => 'r02_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r11_id' => 'ID Registro',
            'p03_vc' => 'Dictamen VC',
            'r02_id' => 'ID Arete',
            'r11_isvaca' => '0:Becerro 1: Vaca',
            'r11_ordenar' => 'Ordenar',
            'r11_ordenar_comp' => 'Ordenar Complementaria',
            'r11_usuAlta' => 'Usuario Alta',
            'r11_fecAlta' => 'Fecha de Alta',
            'r11_usuMod' => 'Usuario Modificación',
            'r11_fecMod' => 'Fecha Modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03Vc()
    {
        return $this->hasOne(P03Vc::className(), ['p03_id' => 'p03_vc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR02()
    {
        return $this->hasOne(Aretes::className(), ['r02_id' => 'r02_id']);
    }
    public static function generarAretes($prueba, $id){

        $aretesSeleccion = SeleccionPreviaAretes::find()->where('p02_id=:id', [':id'=>$prueba->p02_id])->andWhere('r05_vc=:num',[':num'=>1])->joinWith('r02 a')->orderBy('a.r02_numero')->all();
        $contar_si_bovinos_vacas = Yii::$app->db->createCommand("SELECT count(*) as bov from r05_seleccion_previa_aretes p where p02_id=".$prueba->p02_id." and r02_edad>12 and (select r02_especie from r02_aretes where r02_id=p.r02_id)=1")->queryAll();
        $btest =  $contar_si_bovinos_vacas[0]['bov'];
        $contar_si_otros_vacas = Yii::$app->db->createCommand("SELECT count(*) as otros from r05_seleccion_previa_aretes p where p02_id=".$prueba->p02_id." and r02_edad>12 and (select r02_especie from r02_aretes where r02_id=p.r02_id)!=1")->queryAll();
        $otrostest =  $contar_si_otros_vacas[0]['otros'];
        if($btest>0 || $otrostest>0){
            $existen_vacas = true;
        }else{
            $existen_vacas=false;
        }

        //Caratula Vacas; Complementarias Becerros
        $contador_caratula_count=0;
        $contador_caratula=0;
        $contador_complementaria=0;
        $bandera_caraturla=0;
        $bandera_complementaria=0;
        $contador_general=0;
        $contador_complementaria_count=0;

        foreach ($aretesSeleccion as $arete){
            $esp_aux = Aretes::findOne($arete->r02_id);
            if($esp_aux->r02_especie==1){
                $maximo_edad = 12;
            }else{
                $maximo_edad=4;
            }
            $nuevo = new VacunacionAretes();
            $nuevo->p03_vc= $id;
            $nuevo->r02_id = $arete->r02_id;
            $nuevo->r11_usuAlta = Yii::$app->user->getId();

            if($arete->r02_edad>$maximo_edad){
                //Vacas
                $nuevo->r11_isvaca=1;
                if($contador_caratula_count<40){
                    if($bandera_caraturla==0){
                        $nuevo->r11_ordenar=$bandera_caraturla;
                        $bandera_caraturla=1;
                    }else{
                        $nuevo->r11_ordenar=$bandera_caraturla;
                        $bandera_caraturla=0;
                    }
                }else{
                    //Pasa a la complementaria con vacas

                    if($contador_caratula==25){
                        if($bandera_caraturla==0){
                            $bandera_caraturla=1;
                            $contador_caratula=0;
                        }else{
                            $bandera_caraturla=0;
                            $contador_caratula=0;
                        }
                    }
                    $nuevo->r11_ordenar=$bandera_caraturla;
                    $contador_caratula++;
                    //Termina complementaria con vacas
                }

                $contador_caratula_count++;
            }else{
                //Becerro
                $nuevo->r11_isvaca=0;
                if($existen_vacas){
                    if($contador_complementaria==25){
                        if($bandera_complementaria==0){
                            $bandera_complementaria=1;
                            $contador_complementaria=0;
                        }else{
                            $bandera_complementaria=0;
                            $contador_complementaria=0;
                        }
                    }
                    $nuevo->r11_ordenar_comp=$bandera_complementaria;
                    $contador_complementaria++;
                }else{
                    //En caso de que no existan vacas
                    if($contador_complementaria_count<40){
                        if($bandera_complementaria==0){
                            $nuevo->r11_ordenar_comp=$bandera_complementaria;
                            $bandera_complementaria=1;
                        }else{
                            $nuevo->r11_ordenar_comp=$bandera_complementaria;
                            $bandera_complementaria=0;
                        }
                    }else{
                        //Pasa a la complementaria con becerros

                        if($contador_complementaria==25){
                            if($bandera_complementaria==0){
                                $bandera_complementaria=1;
                                $contador_complementaria=0;
                            }else{
                                $bandera_complementaria=0;
                                $contador_complementaria=0;
                            }
                        }
                        $nuevo->r11_ordenar_comp=$bandera_complementaria;
                        $contador_complementaria++;
                        //Termina complementaria con vacas
                    }
                    //
                }


                $contador_complementaria_count++;

            }

            $nuevo->save();
        }

    }
    public static function getAretesPorVacuna($vc){
        $aretes = VacunacionAretes::find()
            ->where('p03_vc=:vc', [':vc'=>$vc]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
