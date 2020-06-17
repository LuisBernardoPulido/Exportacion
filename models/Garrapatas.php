<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "p03_gr".
 *
 * @property integer $p03_id
 * @property integer $c01_id
 * @property string $p03_domicilio
 * @property integer $r01_id
 * @property string $r01_municipio
 * @property string $r01_estado
 * @property integer $p03_cal_banado
 * @property string $p03_fec_ult_trata
 * @property integer $c17_id
 * @property string $p03_destino
 * @property string $p03_municipio
 * @property string $p03_estado
 * @property string $p03_ruta1
 * @property string $p03_ruta2
 * @property string $p03_ruta3
 * @property string $p03_transporte
 * @property string $p03_marca
 * @property string $p03_placas
 * @property integer $p03_capacidad
 * @property string $p03_flejado
 * @property integer $p03_cant_bov
 * @property integer $p03_cant_eq
 * @property integer $p03_cant_capr
 * @property integer $p03_cant_ov
 * @property integer $p03_cant_otros
 * @property integer $c07_id
 * @property string $p03_fec_exp
 * @property string $p03_lugar_exp
 * @property string $p03_fec_venc
 * @property string $p03_exp_nombre
 * @property string $p03_exp_rfc
 * @property string $p03_exp_cargo
 * @property string $p03_avalado_nombre
 * @property string $p03_observaciones
 */
class Garrapatas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p03_gr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['r01_estado', 'p03_cal_banado', 'c17_id','p03_municipio', 'p03_estado','p03_transporte', 'p03_marca', 'p03_placas', 'p03_capacidad', 'p03_flejado', 'p03_fec_exp', 'p03_fec_venc'], 'required'],
            [['r01_estado', 'p03_cal_banado', 'c17_id','p03_municipio', 'p03_estado','p03_transporte', 'p03_marca', 'p03_placas', 'p03_capacidad', 'p03_flejado', 'p03_fec_exp', 'p03_fec_venc', 'c07_id', 'p03_destino','p03_otro_motivo'], 'required'],
            [['c01_id', 'r01_id', 'p03_cal_banado', 'c17_id', 'p03_capacidad', 'p03_cant_bov', 'p03_cant_eq', 'p03_cant_capr', 'p03_cant_ov', 'p03_cant_otros', 'c07_id','p03_flejado'], 'integer'],
            [['p03_fec_ult_trata', 'p03_fec_exp', 'p03_fec_venc'], 'safe'],
            [['p03_exp_cargo'], 'string'],
            [['p03_domicilio'], 'string', 'max' => 200],
            //[['r01_municipio', 'r01_estado', 'p03_municipio', 'p03_estado', 'p03_transporte', 'p03_marca','p03_folio'], 'string', 'max' => 50],
            [['r01_municipio', 'r01_estado', 'p03_municipio', 'p03_estado', 'p03_transporte', 'p03_marca'], 'string', 'max' => 50],
            [['p03_destino', 'p03_ruta1', 'p03_ruta2', 'p03_ruta3', 'p03_avalado_nombre','p03_otro_motivo'], 'string', 'max' => 100],
            [['p03_placas'], 'string', 'max' => 20],
            [['p03_lugar_exp', 'p03_exp_nombre', 'p03_observaciones'], 'string', 'max' => 150],
            [['p03_exp_rfc'], 'string', 'max' => 14],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p03_id' => 'ID Prueba',
            'p03_folio' => 'Folio',
            'c01_id' => 'Productor',
            'p03_domicilio' => 'Domicilio del productor',
            'r01_id' => 'Unidad de Producción',
            'r01_municipio' => 'Municipio Unidad',
            'r01_estado' => 'Estado Unidad',
            'p03_cal_banado' => 'Calendario de Bañado',
            'p03_fec_ult_trata' => 'Fecha Último Tratamiento',
            'c17_id' => 'Producto',
            'p03_destino' => 'Predio Destino o Punto de Control',
            'p03_municipio' => 'Municipio Destino',
            'p03_estado' => 'Estado Destino',
            'p03_ruta1' => 'Ruta 1',
            'p03_ruta2' => 'Ruta 2',
            'p03_ruta3' => 'Ruta 3',
            'p03_transporte' => 'Tipo de Transporte',
            'p03_marca' => 'Marca',
            'p03_placas' => 'Placas',
            'p03_capacidad' => 'Capacidad',
            'p03_flejado' => 'Flejado',
            'p03_cant_bov' => 'Cantidad Bovinos',
            'p03_cant_eq' => 'Cantidad Equinos',
            'p03_cant_capr' => 'Cantidad Caprinos',
            'p03_cant_ov' => 'Cantidad Ovinos',
            'p03_cant_otros' => 'Cantidad de Otros',
            'c07_id' => 'Motivo Prueba',
            'p03_otro_motivo' => 'Motivo',
            'p03_fec_exp' => 'Fecha de expedición',
            'p03_lugar_exp' => 'Lugar Expedición',
            'p03_fec_venc' => 'Fecha Vencimiento',
            'p03_exp_nombre' => 'Nombre de quien expide',
            'p03_exp_rfc' => 'RFC de quien expide',
            'p03_exp_cargo' => 'Cargo de quien expide',
            'p03_avalado_nombre' => 'Nombre de quien avala',
            'p03_observaciones' => 'Observaciones',
        ];
    }

    public static function getRepetidos($upp,$fecha,$prueba){
        $repetidos = Garrapatas::find()->where(['r01_id' => $upp])
            ->andWhere(['p03_fec_exp' => $fecha])
            ->andWhere(['c07_id' => $prueba]);

        $dataprovider = new ActiveDataProvider([
            'query' => $repetidos,
            'pagination' => ['pageSize' => 50],
        ]);

        return $dataprovider;

    }
}
