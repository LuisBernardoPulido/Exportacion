<?php

namespace app\models;

use app\controllers\SeleccionPreviaController;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "p03_br".
 *
 * @property integer $p03_id
 * @property integer $p03_folio
 * @property integer $p03_nocaso
 * @property integer $c05_id
 * @property integer $c01_id
 * @property integer $r01_id
 * @property string $p03_fpruebaAnt
 * @property integer $p03_dictamenAnt
 * @property string $p03_fproxPrueba
 * @property string $p03_tipoPrueba
 * @property string $p03_espTipo
 * @property string $p03_motivoPrueba
 * @property string $p03_espMotivo
 * @property integer $p03_funcZoo
 * @property integer $p03_tipoMuestras
 * @property string $p03_fmuestreo
 * @property string $p03_frecepcion
 * @property string $p03_frealizacion
 * @property integer $p03_tipomvz
 * @property string $p03_tipoAux
 * @property string $p03_fecha
 * @property integer $p03_totalHato
 * @property integer $p03_muestraHato
 * @property integer $p03_consHatoNo
 * @property string $p03_constHatoFecha
 * @property string $p03_vigencia
 * @property integer $p03_activo
 * @property integer $p03_isdictaminado
 * @property integer $p03_rv
 * @property integer $p03_fj
 * @property integer $p03_fjsend
 * @property integer $p03_laboratorio
 * @property integer $p03_usuAlta
 * @property string $p03_fecAlta
 * @property integer $p03_usuMod
 * @property string $p03_fecMod
 *
 * @property C05Mvz $c05
 * @property C01Ganaderos $c01
 * @property R01Upp $r01
 * @property C07MotivoPrueba $p03MotivoPrueba
 * @property C08TipoPrueba $p03TipoPrueba
 * @property C09FuncionZoo $p03FuncZoo
 */
class Brucelosis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p03_br';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_id', 'c01_id', 'r01_id', 'p03_tipoPrueba', 'p03_motivoPrueba', 'p03_fmuestreo', 'p03_laboratorio', 'p03_funcZoo'], 'required'],
            [['p03_id', 'p03_nocaso', 'p03_isdictaminado', 'p03_rv', 'p03_fj', 'p03_fjsend', 'c05_id', 'p03_tipoMuestras','c01_id', 'r01_id', 'p03_dictamenAnt', 'p03_tipoPrueba', 'p03_motivoPrueba', 'p03_funcZoo', 'p03_tipomvz', 'p03_totalHato', 'p03_laboratorio', 'p03_muestraHato', 'p03_consHatoNo', 'p03_activo', 'p03_usuAlta', 'p03_usuMod'], 'integer'],
            [['p03_fpruebaAnt', 'p03_fproxPrueba', 'p03_fmuestreo', 'p03_frecepcion', 'p03_frealizacion', 'p03_fecha', 'p03_constHatoFecha', 'p03_vigencia', 'p03_fecAlta', 'p03_fecMod'], 'safe'],
            [['p03_tipoAux'], 'string'],
            [['p03_espTipo', 'p03_espMotivo'], 'string', 'max' => 50],
            [['c05_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['c05_id' => 'c05_id']],
            [['c01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ganaderos::className(), 'targetAttribute' => ['c01_id' => 'c01_id']],
            [['r01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_id' => 'r01_id']],
            [['p03_motivoPrueba'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoPrueba::className(), 'targetAttribute' => ['p03_motivoPrueba' => 'c07_id']],
            [['p03_tipoPrueba'], 'exist', 'skipOnError' => true, 'targetClass' => TipoPrueba::className(), 'targetAttribute' => ['p03_tipoPrueba' => 'c08_id']],
            [['p03_funcZoo'], 'exist', 'skipOnError' => true, 'targetClass' => FuncionesZoo::className(), 'targetAttribute' => ['p03_funcZoo' => 'c09_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p03_id' => 'ID BR',
            'p03_folio' => 'Folio',
            'p03_nocaso' => 'No. de Caso',
            'c05_id' => 'Médico',
            'c01_id' => 'Productor',
            'r01_id' => 'Clave UPP',
            'p03_fpruebaAnt' => 'Fecha de Prueba Anterior',
            'p03_dictamenAnt' => 'Dictamen Anterior',
            'p03_fproxPrueba' => 'Fecha de Proxima Prueba',
            'p03_tipoPrueba' => 'Tipo de Prueba Realizada',
            'p03_espTipo' => 'Especificación Tipo',
            'p03_motivoPrueba' => 'Motivo de la Prueba',
            'p03_espMotivo' => 'Especificación Motivo',
            'p03_funcZoo' => 'Función zootécnica',
            'p03_fmuestreo' => 'Fecha de Muestreo',
            'p03_frecepcion' => 'Fecha de Recepción',
            'p03_tipoMuestras' => 'Tipo de Muestras',
            'p03_frealizacion' => 'Fecha de Prueba',
            'p03_tipomvz' => 'Tipo MVZ',
            'p03_tipoAux' => 'Tipo de la prueba Auxiliar',
            'p03_fecha' => 'Fecha de Envío de Resultados',
            'p03_totalHato' => 'Totalidad del Hato',
            'p03_muestraHato' => 'Muestra de Hato',
            'p03_consHatoNo' => 'Constancia de Hato Libre No.',
            'p03_constHatoFecha' => 'Constancia de Hato Libre Fecha',
            'p03_vigencia' => 'Vigencia',
            'p03_activo' => 'Estatus',
            'p03_isdictaminado' => 'Dictaminado',
            'p03_rv' => 'Rivanol',
            'p03_fj' => 'Fijación',
            'p03_fjsend' => 'FIjación Enviada',
            'p03_laboratorio' => 'Laboratorio Asignado',
            'p03_usuAlta' => 'Usuario de Alta',
            'p03_fecAlta' => 'Fecha de Alta',
            'p03_usuMod' => 'Usuario de Modificación',
            'p03_fecMod' => 'Fecha de Modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC05()
    {
        return $this->hasOne(C05Mvz::className(), ['c05_id' => 'c05_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC01()
    {
        return $this->hasOne(C01Ganaderos::className(), ['c01_id' => 'c01_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR01()
    {
        return $this->hasOne(R01Upp::className(), ['r01_id' => 'r01_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03MotivoPrueba()
    {
        return $this->hasOne(C07MotivoPrueba::className(), ['c07_id' => 'p03_motivoPrueba']);
    }

    public static function getRepetidos($upp,$fecha,$prueba){
        $repetidos = Brucelosis::find()->where(['r01_id' => $upp])
            ->andWhere(['p03_fmuestreo' => $fecha])
            ->andWhere(['p03_tipoPrueba' => $prueba]);

        $dataprovider = new ActiveDataProvider([
            'query' => $repetidos,
            'pagination' => ['pageSize' => 50],
        ]);

        return $dataprovider;

    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03TipoPrueba()
    {
        return $this->hasOne(C08TipoPrueba::className(), ['c08_id' => 'p03_tipoPrueba']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03FuncZoo()
    {
        return $this->hasOne(C09FuncionZoo::className(), ['c09_id' => 'p03_funcZoo']);
    }
    public static function generarRivanol($model, $aretes){

        $return = false;

        $tb_new = new Brucelosis();
        $tb_new->p03_nocaso = $model->p03_nocaso;
        $tb_new->c05_id = $model->c05_id;
        $tb_new->c01_id = $model->c01_id;
        $tb_new->r01_id = $model->r01_id;
        $tb_new->p03_fpruebaAnt = $model->p03_frealizacion;
        $tb_new->p03_dictamenAnt = $model->p03_id;
        $tb_new->p03_tipoPrueba = 3;
        $tb_new->p03_motivoPrueba = $model->p03_motivoPrueba;
        $tb_new->p03_funcZoo = $model->p03_funcZoo;
        $tb_new->p03_tipoMuestras = $model->p03_tipoMuestras;
        $tb_new->p03_fmuestreo = $model->p03_fmuestreo;
        $tb_new->p03_frecepcion = $model->p03_frecepcion;
        $tb_new->p03_frealizacion = $model->p03_frealizacion;
        $tb_new->p03_fecha = $model->p03_fecha;
        $tb_new->p03_tipomvz = $model->p03_tipomvz;
        $tb_new->p03_activo = 1;
        $tb_new->p03_isdictaminado =1;
        $tb_new->p03_laboratorio = $model->p03_laboratorio;
        $tb_new->p03_rv = $model->p03_id;
        $tb_new->p03_usuAlta = $model->p03_usuAlta;
        $tb_new->p03_liberado = 1;
        //if($model->p03_laboratorio==56 || $model->p03_laboratorio==58)
        //    $tb_new->p03_liberado=0;

        if($tb_new->save()){
            SeleccionPreviaController::guardarInforDictamen($tb_new, '2');
            $return =true;
        }else{
            $return =false;
        }

        $contador_ordenar=0;
        $contador_ordenar_10=0;
        $contador_general_ordenar_10=0;
        $bandera_ordenar=0;
        $bandera_ordenar_10=0;
        foreach ($aretes as $arr){
            $n = new BrucelosisAretes();
            $n->p03_br = $tb_new->p03_id;
            $n->r02_id = $arr->r02_id;
            $n->r07_rivanol = $arr->r07_rivanol;
            $n->r07_resultado = $arr->r07_resultado;
            $n->r07_usuAlta = Yii::$app->user->getId();

            //
            if($contador_ordenar==25){
                if($bandera_ordenar==0){
                    $bandera_ordenar=1;
                    $contador_ordenar=0;
                }else{
                    $bandera_ordenar=0;
                    $contador_ordenar=0;
                }
            }
            $n->r07_ordenar=$bandera_ordenar;
            $contador_ordenar++;

            //Para dictamen 10 y 10; 25 y 25

            if($contador_general_ordenar_10<20){
                if($contador_general_ordenar_10==10){
                    $bandera_ordenar_10=1;
                }
            }else{
                if($contador_ordenar_10==25){
                    if($bandera_ordenar_10==0){
                        $bandera_ordenar_10=1;
                        $contador_ordenar_10=0;
                    }else{
                        $bandera_ordenar_10=0;
                        $contador_ordenar_10=0;
                    }
                }
            }
            $n->r07_ordenar_dictamen=$bandera_ordenar_10;
            if($contador_general_ordenar_10==19){
                $bandera_ordenar_10=0;
            }
            if($contador_general_ordenar_10>=20){
                $contador_ordenar_10++;
            }

            $contador_general_ordenar_10++;

            //

            $n->save();
        }

        return $return;

    }

    public static function generarArtesRivanol($model, $aretes){
        //$return = false;

        $contador_ordenar=0;
        $contador_ordenar_10=0;
        $contador_general_ordenar_10=0;
        $bandera_ordenar=0;
        $bandera_ordenar_10=0;
        foreach ($aretes as $arr){
            $n = new BrucelosisAretes();
            $n->p03_br = $model->p03_id;
            $n->r02_id = $arr->r02_id;
            $n->r07_rivanol = $arr->r07_rivanol;
            $n->r07_resultado = $arr->r07_resultado;
            $n->r07_usuAlta = Yii::$app->user->getId();

            //
            if($contador_ordenar==25){
                if($bandera_ordenar==0){
                    $bandera_ordenar=1;
                    $contador_ordenar=0;
                }else{
                    $bandera_ordenar=0;
                    $contador_ordenar=0;
                }
            }
            $n->r07_ordenar=$bandera_ordenar;
            $contador_ordenar++;

            //Para dictamen 10 y 10; 25 y 25

            if($contador_general_ordenar_10<20){
                if($contador_general_ordenar_10==10){
                    $bandera_ordenar_10=1;
                }
            }else{
                if($contador_ordenar_10==25){
                    if($bandera_ordenar_10==0){
                        $bandera_ordenar_10=1;
                        $contador_ordenar_10=0;
                    }else{
                        $bandera_ordenar_10=0;
                        $contador_ordenar_10=0;
                    }
                }
            }
            $n->r07_ordenar_dictamen=$bandera_ordenar_10;
            if($contador_general_ordenar_10==19){
                $bandera_ordenar_10=0;
            }
            if($contador_general_ordenar_10>=20){
                $contador_ordenar_10++;
            }

            $contador_general_ordenar_10++;

            //

            $n->save();
        }

        //return $return;
    }

    public static function generarComplemento($model){

        $return = false;

        $br = new Brucelosis();
        $br->p03_nocaso = $model->p03_nocaso;
        $br->c05_id = $model->c05_id;
        $br->c01_id = $model->c01_id;
        $br->r01_id = $model->r01_id;
        $br->p03_fpruebaAnt = $model->p03_frealizacion;
        $br->p03_dictamenAnt = $model->p03_id;
        $br->p03_tipoPrueba = 4;
        $br->p03_motivoPrueba = $model->p03_motivoPrueba;
        $br->p03_funcZoo = $model->p03_funcZoo;
        $br->p03_tipoMuestras = $model->p03_tipoMuestras;
        $br->p03_fmuestreo = $model->p03_fmuestreo;
        $br->p03_frecepcion = $model->p03_frecepcion;
        $br->p03_frealizacion = $model->p03_frealizacion;
        $br->p03_fecha = $model->p03_fecha;
        $br->p03_tipomvz = $model->p03_tipomvz;
        $br->p03_activo = 1;
        $br->p03_isdictaminado =0;
        $br->p03_laboratorio = $model->p03_laboratorio;
        //$br->p03_rv = $model->p03_id;
        $br->p03_fj = $model->p03_id;
        $br->p03_fjsend=0;
        $br->p03_usuAlta = Yii::$app->user->getId();
        if($br->save()){
            $return =true;
            SeleccionPreviaController::guardarInforDictamen($br, '2');
        }else{
            $return =false;
        }

        $aretes =  BrucelosisAretes::find()->where('r07_rivanol!=:pos', [':pos'=>BrucelosisAretes::NEGATIVO_RV])->andWhere('p03_br=:id', [':id'=>$model->p03_id])->all();

        foreach ($aretes as $arr){
            $n = new BrucelosisAretes();
            $n->p03_br = $br->p03_id;
            $n->r02_id = $arr->r02_id;
            //$n->r07_rivanol = $arr->r07_rivanol;
            //$n->r07_resultado = $arr->r07_resultado;
            $n->r07_usuAlta = Yii::$app->user->getId();
            $n->save();
        }

        return $return;

    }
    public static function generarNewComplemento($model){

        $return = false;

        $br = new Brucelosis();
        $br->p03_nocaso = $model->p03_nocaso;
        $br->c05_id = $model->c05_id;
        $br->c01_id = $model->c01_id;
        $br->r01_id = $model->r01_id;
        $br->p03_fpruebaAnt = $model->p03_frealizacion;
        $br->p03_dictamenAnt = $model->p03_id;
        $br->p03_tipoPrueba = 4;
        $br->p03_motivoPrueba = $model->p03_motivoPrueba;
        $br->p03_funcZoo = $model->p03_funcZoo;
        $br->p03_tipoMuestras = $model->p03_tipoMuestras;
        $br->p03_fmuestreo = $model->p03_fmuestreo;
        $br->p03_frecepcion = $model->p03_frecepcion;
        $br->p03_frealizacion = $model->p03_frealizacion;
        $br->p03_fecha = $model->p03_fecha;
        $br->p03_tipomvz = $model->p03_tipomvz;
        $br->p03_activo = 1;
        $br->p03_isdictaminado =0;
        $br->p03_laboratorio = $model->p03_laboratorio;
        //$br->p03_rv = $model->p03_id;
        $br->p03_fj = $model->p03_id;
        $br->p03_fjsend=0;
        $br->p03_usuAlta = Yii::$app->user->getId();
        $br->p03_liberado = 1;
        //if($model->p03_laboratorio==56 || $model->p03_laboratorio==58)
        //    $br->p03_liberado=0;
        if($br->save()){
            SeleccionPreviaController::guardarInforDictamen($br, '2');
            $return =true;
        }else{
            $return =false;
        }

        //$aretes =  BrucelosisAretes::find()->where('r07_rivanol!=:pos', [':pos'=>BrucelosisAretes::NEGATIVO_RV])->andWhere('p03_br=:id', [':id'=>$model->p03_id])->all();

        $aretes = BrucelosisAretes::find()->where('r07_resultado=:pos', [':pos'=>BrucelosisAretes::POSITIVO])
            ->andWhere('p03_br=:id', [':id'=>$model->p03_id])->all();
        foreach ($aretes as $arr){
            $n = new BrucelosisAretes();
            $n->p03_br = $br->p03_id;
            $n->r02_id = $arr->r02_id;
            $n->r07_usuAlta = Yii::$app->user->getId();
            $n->save();
        }

        return $return;

    }
    public static function RevisaCaprinosOvinos($model){
        $aretes = BrucelosisAretes::find()->where('p03_br=:id', [':id'=>$model->p03_id]);
        $total = $aretes->count();

        $total_temp=0;
        foreach ($aretes->all() as $a){
            $arete_origen = Aretes::findOne($a->r02_id);
            if($arete_origen->r02_especie!= 1){
                $total_temp++;
            }
        }
        if($total==$total_temp){
            return false;
        }else{
            return true;
        }
    }

    public static function generarArtesFijacion($model, $aretes){

        foreach ($aretes as $arr){
            $n = new BrucelosisAretes();
            $n->p03_br = $model->p03_id;
            $n->r02_id = $arr->r02_id;
            //$n->r07_rivanol = $arr->r07_rivanol;
            //$n->r07_resultado = $arr->r07_resultado;
            $n->r07_usuAlta = Yii::$app->user->getId();
            $n->save();
        }

    }
}
