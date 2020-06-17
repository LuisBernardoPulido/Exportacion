<?php

namespace app\models;

use app\controllers\SeleccionPreviaController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "p03_tb".
 *
 * @property integer $p03_id
 * @property integer $p03_folio
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
 * @property string $p03_finyeccion
 * @property string $p03_flectura
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
 * @property integer $p03_cc
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
 * @property SeleccionPrevia $seleccionPrevia
 */
class Tuberculosis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p03_tb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_id', 'c01_id', 'r01_id', 'p03_tipoPrueba', 'p03_motivoPrueba', 'p03_finyeccion', 'p03_flectura', 'p03_funcZoo'], 'required'],
            [['p03_id', 'p03_folio', 'c05_id', 'c01_id', 'r01_id', 'p03_dictamenAnt','p03_tipoPrueba', 'p03_motivoPrueba', 'p03_funcZoo', 'p03_tipomvz', 'p03_totalHato', 'p03_muestraHato', 'p03_consHatoNo', 'p03_activo', 'p03_isdictaminado', 'p03_cc', 'p03_usuAlta', 'p03_usuMod'], 'integer'],
            [['p03_fpruebaAnt', 'p03_fproxPrueba', 'p03_finyeccion', 'p03_flectura', 'p03_fecha', 'p03_constHatoFecha', 'p03_vigencia', 'p03_fecAlta', 'p03_fecMod'], 'safe'],
            [['p03_tipoAux'], 'string'],
            [['p03_espTipo', 'p03_espMotivo'], 'string', 'max' => 50],
            [['c05_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['c05_id' => 'c05_id']],
            [['c01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ganaderos::className(), 'targetAttribute' => ['c01_id' => 'c01_id']],
            [['r01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_id' => 'r01_id']],
            [['p03_motivoPrueba'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoPrueba::className(), 'targetAttribute' => ['p03_motivoPrueba' => 'c07_id']],
            [['p03_tipoPrueba'], 'exist', 'skipOnError' => true, 'targetClass' => TipoPrueba::className(), 'targetAttribute' => ['p03_tipoPrueba' => 'c08_id']],
            [['p03_funcZoo'], 'exist', 'skipOnError' => true, 'targetClass' => FuncionesZoo::className(), 'targetAttribute' => ['p03_funcZoo' => 'c09_id']],
            [['p03_folio'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p03_id' => 'ID TB',
            'p03_folio' => 'Folio',
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
            'p03_finyeccion' => 'Fecha de inyección',
            'p03_flectura' => 'Fecha de Lectura',
            'p03_tipomvz' => 'Tipo MVZ',
            'p03_tipoAux' => 'Tipo de la prueba Auxiliar',
            'p03_fecha' => 'Fecha de Prueba',
            'p03_totalHato' => 'Totalidad del Hato',
            'p03_muestraHato' => 'Muestra de Hato',
            'p03_consHatoNo' => 'Constancia de Hato Libre Número',
            'p03_constHatoFecha' => 'Constancia de Hato Libre Fecha',
            'p03_vigencia' => 'Vigencia',
            'p03_activo' => 'Estatus',
            'p03_isdictaminado' => 'Dictaminado',
            'p03_cc' => 'Cervical Comparativa',
            'p03_usuAlta' => 'Usuario Alta',
            'p03_fecAlta' => 'Fecha de Alta',
            'p03_usuMod' => 'Usuario de Modificación',
            'p03_fecMod' => 'Fecha de Modificación',
            'p02_id'=>'Hola',
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
    public function getSeleccionPrevia()
    {
        //return SeleccionPrevia::()->where('r03_dictamen_tb=:tb', [':tb'=>'p03_id'])->one();
        return $this->hasOne(SeleccionPrevia::className(), ['r03_dictamen_tb' => 'p03_id']);
    }

    public static function getRepetidos($upp,$fecha,$prueba){
        $repetidos = Tuberculosis::find()->where(['r01_id' => $upp])
                                         ->andWhere(['p03_finyeccion' => $fecha])
                                         ->andWhere(['p03_tipoPrueba' => $prueba]);

        $dataprovider = new ActiveDataProvider([
            'query' => $repetidos,
            'pagination' => ['pageSize' => 50],
        ]);

        return $dataprovider;

    }

    public static function generarCervicalComparativa($model, $aretes){

        $return = false;

        $tb_new = new Tuberculosis();
        $tb_new->c05_id = $model->c05_id;
        $tb_new->c01_id = $model->c01_id;
        $tb_new->r01_id = $model->r01_id;
        $tb_new->p03_fpruebaAnt = $model->p03_flectura;
        $tb_new->p03_dictamenAnt = $model->p03_id;
        $tb_new->p03_tipoPrueba = 5;
        $tb_new->p03_motivoPrueba = $model->p03_motivoPrueba;
        $tb_new->p03_funcZoo = $model->p03_funcZoo;
        $tb_new->p03_tipomvz = $model->p03_tipomvz;
        $tb_new->p03_finyeccion = $model->p03_flectura;
        $tb_new->p03_flectura = Yii::$app->db->createCommand('SELECT DATE_ADD(:iny, interval 3 day)', [':iny'=>$model->p03_flectura])->queryScalar();
        $tb_new->p03_activo = 1;
        $tb_new->p03_isdictaminado =0;
        $tb_new->p03_cc = $model->p03_id;
        $tb_new->p03_usuAlta = Yii::$app->user->getId();
        if($tb_new->save()){
            SeleccionPreviaController::guardarInforDictamen($tb_new, '1');
            $return =true;
        }else{
            $return =false;
        }

        return $return;

    }

    public static function getBusquedaDictamenes($med, $tipo_dictamen, $mostrar, $fol){
        if($med!=null){
            if($tipo_dictamen==1){
                if($mostrar==1){
                    if($fol==1)
                        $dictamenes = Tuberculosis::find()->where('c05_id=:id', [':id'=>$med]);
                    else if($fol==2)
                        $dictamenes = Tuberculosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('p03_folio IS NOT NULL');
                    else if($fol==3)
                        $dictamenes = Tuberculosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('p03_folio IS NULL');
                }
                else if($mostrar==2){
                    if($fol==1)
                        $dictamenes = Tuberculosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=1');
                    else if($fol==2)
                        $dictamenes = Tuberculosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=1')->andWhere('p03_folio IS NOT NULL');
                    else if($fol==3)
                        $dictamenes = Tuberculosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=1')->andWhere('p03_folio IS NULL');
                }
                else if($mostrar==3){
                    if($fol==1)
                        $dictamenes = Tuberculosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=0');
                    else if($fol==2)
                        $dictamenes = Tuberculosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=0')->andWhere('p03_folio IS NOT NULL');
                    else if($fol==3)
                        $dictamenes = Tuberculosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=0')->andWhere('p03_folio IS NULL');
                }
                //$dictamenes = Tuberculosis::find()
                //    ->alias('p03')
                //    ->join('INNER JOIN', 'r16_folios_medicos r16', 'p03.p03_id=r16.p03_id')
                //    ->where('p03.c05_id=:id', [':id'=>$med]);
            }
            if($tipo_dictamen==2){
                if($mostrar==1){
                    if($fol==1)
                        $dictamenes = Brucelosis::find()->where('c05_id=:id', [':id'=>$med]);
                    else if($fol==2)
                        $dictamenes = Brucelosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('p03_folio IS NOT NULL');
                    else if($fol==3)
                        $dictamenes = Brucelosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('p03_folio IS NULL');
                }
                else if($mostrar==2){
                    if($fol==1)
                        $dictamenes = Brucelosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=1');
                    else if($fol==2)
                        $dictamenes = Brucelosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=1')->andWhere('p03_folio IS NOT NULL');
                    else if($fol==3)
                        $dictamenes = Brucelosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=1')->andWhere('p03_folio IS NULL');
                }
                else if($mostrar==3){
                    if($fol==1)
                        $dictamenes = Brucelosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=0');
                    else if($fol==2)
                        $dictamenes = Brucelosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=0')->andWhere('p03_folio IS NOT NULL');
                    else if($fol==3)
                        $dictamenes = Brucelosis::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=0')->andWhere('p03_folio IS NULL');
                }
            }
            if($tipo_dictamen==3){
                if($mostrar==1){
                    if($fol==1)
                        $dictamenes = Vacunacion::find()->where('c05_id=:id', [':id'=>$med]);
                    else if($fol==2)
                        $dictamenes = Vacunacion::find()->where('c05_id=:id', [':id'=>$med])->andWhere('p03_folio IS NOT NULL');
                    else if($fol==3)
                        $dictamenes = Vacunacion::find()->where('c05_id=:id', [':id'=>$med])->andWhere('p03_folio IS NULL');
                }
                else if($mostrar==2){
                    if($fol==1)
                        $dictamenes = Vacunacion::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=1');
                    else if($fol==2)
                        $dictamenes = Vacunacion::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=1')->andWhere('p03_folio IS NOT NULL');
                    else if($fol==3)
                        $dictamenes = Vacunacion::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=1')->andWhere('p03_folio IS NULL');
                }
                else if($mostrar==3){
                    if($fol==1)
                        $dictamenes = Vacunacion::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=0');
                    else if($fol==2)
                        $dictamenes = Vacunacion::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=0')->andWhere('p03_folio IS NOT NULL');
                    else if($fol==3)
                        $dictamenes = Vacunacion::find()->where('c05_id=:id', [':id'=>$med])->andWhere('r16_entregado=0')->andWhere('p03_folio IS NULL');
                }
            }

            $dataprovider = new ActiveDataProvider([
                'query' => $dictamenes->orderBy(['p03_fecAlta'=>SORT_DESC]),
                'pagination' => ['pageSize' => 50],
            ]);
            return $dataprovider;
        }

    }

}
