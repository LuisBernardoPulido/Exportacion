<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "p03_vc".
 *
 * @property integer $p03_id
 * @property integer $p03_folio
 * @property integer $c05_id
 * @property integer $c01_id
 * @property integer $r01_id
 * @property string $p03_fexpedicion
 * @property integer $p03_totalHato
 * @property integer $p03_totalbovinos
 * @property integer $p03_totalcaprinos
 * @property integer $p03_totalovinos
 * @property integer $p03_totalotros
 * @property string $p03_esptotalotros
 * @property integer $p03_tipohato
 * @property integer $p03_cepa
 * @property integer $p03_rb
 * @property integer $p03_rev
 * @property string $p03_laboratorio
 * @property string $p03_lote_clasica
 * @property string $p03_lote_reducida
 * @property string $p03_lote_becerra
 * @property string $p03_lote_vaca
 * @property string $p03_cad_clasica
 * @property string $p03_cad_reducida
 * @property string $p03_cad_becerra
 * @property string $p03_cad_vaca
 * @property string $p03_vigencia
 * @property integer $p03_isdictaminado
 * @property integer $p03_activo
 * @property integer $p03_usuAlta
 * @property string $p03_fecAlta
 * @property integer $p03_usuMod
 * @property string $p03_fecMod
 *
 * @property C05Mvz $c05
 * @property C01Ganaderos $c01
 * @property R01Upp $r01
 * @property C11Especies $p03Tipohato
 * @property R11VacunacionAretes[] $r11VacunacionAretes
 */
class Vacunacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const PRIMERA_OPCION =0;
    const SEGUNDA_OPCION =1;
    const AMBAS =2;
    public static function tableName()
    {
        return 'p03_vc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p03_folio', 'c05_id', 'c01_id', 'r01_id', 'p03_totalHato', 'p03_totalbovinos', 'p03_totalcaprinos', 'p03_totalovinos', 'p03_totalotros', 'p03_tipohato', 'p03_cepa', 'p03_rb', 'p03_rev', 'p03_activo', 'p03_isdictaminado', 'p03_usuAlta', 'p03_usuMod'], 'integer'],
            [['c05_id', 'c01_id', 'r01_id', 'p03_fexpedicion', 'p03_tipohato', 'p03_laboratorio'], 'required'],
            [['p03_fexpedicion', 'p03_cad_clasica', 'p03_cad_reducida', 'p03_cad_becerra', 'p03_cad_vaca', 'p03_vigencia', 'p03_fecAlta', 'p03_fecMod'], 'safe'],
            [['p03_esptotalotros'], 'string', 'max' => 50],
            [['p03_laboratorio', 'p03_lote_clasica', 'p03_lote_reducida', 'p03_lote_becerra', 'p03_lote_vaca'], 'string', 'max' => 200],
            [['c05_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['c05_id' => 'c05_id']],
            [['c01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ganaderos::className(), 'targetAttribute' => ['c01_id' => 'c01_id']],
            [['r01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['r01_id' => 'r01_id']],
            [['p03_tipohato'], 'exist', 'skipOnError' => true, 'targetClass' => Especies::className(), 'targetAttribute' => ['p03_tipohato' => 'c11_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p03_id' => 'ID Vacuna',
            'p03_folio' => 'Folio',
            'c05_id' => 'Médico',
            'c01_id' => 'Productor',
            'r01_id' => 'Clave UPP',
            'p03_fexpedicion' => 'Fecha de Expedición',
            'p03_totalHato' => 'Totalidad del Hato',
            'p03_totalbovinos' => 'Total Bovinos',
            'p03_totalcaprinos' => 'Total Caprinos',
            'p03_totalovinos' => 'Total Ovinos',
            'p03_totalotros' => 'Total Otros',
            'p03_esptotalotros' => 'Especificación Total Otros',
            'p03_tipohato' => 'Tipo de Hato',
            'p03_cepa' => 'CEPA',
            'p03_rb' => 'RB',
            'p03_rev' => 'REV',
            'p03_laboratorio' => 'Laboratorio',
            'p03_lote_clasica' => 'Lote',
            'p03_lote_reducida' => 'Lote',
            'p03_lote_becerra' => 'Lote',
            'p03_lote_vaca' => 'Lote',
            'p03_cad_clasica' => 'Fecha de Caducidad',
            'p03_cad_reducida' => 'Fecha de Caducidad',
            'p03_cad_becerra' => 'Fecha de Caducidad',
            'p03_cad_vaca' => 'Fecha de Caducidad',
            'p03_vigencia' => 'Vigencia',
            'p03_isdictaminado' => 'Es Dictaminado',
            'p03_activo' => 'Estatus',
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
    public function getP03Tipohato()
    {
        return $this->hasOne(C11Especies::className(), ['c11_id' => 'p03_tipohato']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR11VacunacionAretes()
    {
        return $this->hasMany(R11VacunacionAretes::className(), ['p03_vc' => 'p03_id']);
    }

    public static function getRepetidos($upp,$fecha){
        $repetidos = Vacunacion::find()->where(['r01_id' => $upp])
            ->andWhere(['p03_fexpedicion' => $fecha]);

        $dataprovider = new ActiveDataProvider([
            'query' => $repetidos,
            'pagination' => ['pageSize' => 50],
        ]);

        return $dataprovider;

    }
}
