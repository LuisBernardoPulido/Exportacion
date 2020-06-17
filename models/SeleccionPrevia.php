<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "p02_seleccion_previa".
 *
 * @property integer $p02_id
 * @property integer $c05_id
 * @property integer $c01_id
 * @property integer $c01_ganadero
 * @property integer $r03_dictamen_tb
 * @property integer $r03_dictamen_vc
 * @property integer $r03_dictamen_br
 * @property integer $p02_activo
 * @property integer $p02_usuAlta
 * @property string $p02_fecAlta
 * @property integer $p02_usuMod
 * @property string $p02_fecMod
 *
 * @property C05Mvz $c05
 * @property R01Upp $c01
 * @property R05SeleccionPreviaAretes[] $r05SeleccionPreviaAretes
 */
class SeleccionPrevia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p02_seleccion_previa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_id', 'c01_ganadero'], 'required'],
            [['c05_id', 'c01_id', 'r03_dictamen_tb', 'r03_dictamen_vc', 'p02_activo', 'r03_dictamen_br', 'p02_usuAlta', 'p02_usuMod','r03_dictamen_gr'], 'integer'],
            [['p02_fecAlta', 'p02_fecMod'], 'safe'],
            [['c05_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['c05_id' => 'c05_id']],
            [['c01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Upp::className(), 'targetAttribute' => ['c01_id' => 'r01_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p02_id' => '#',
            'c05_id' => 'Médico',
            'c01_id' => 'Clave UPP',
            'c01_ganadero' => 'Productor',
            'r03_dictamen_tb' => 'TB',
            'r03_dictamen_vc' => 'VC',
            'r03_dictamen_br' => 'BR',
            'r03_dictamen_gr' => 'GR',
            'p02_activo' => 'Estatus',
            'p02_usuAlta' => 'Usuario Alta',
            'p02_fecAlta' => 'Fecha de Alta',
            'p02_usuMod' => 'Usuario Modificación',
            'p02_fecMod' => 'Fecha Modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC05()
    {
        return $this->hasOne(Medicos::className(), ['c05_id' => 'c05_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC01()
    {
        return $this->hasOne(Upp::className(), ['r01_id' => 'c01_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR05SeleccionPreviaAretes()
    {
        return $this->hasMany(SeleccionPreviaAretes::className(), ['p02_id' => 'p02_id']);
    }
}
