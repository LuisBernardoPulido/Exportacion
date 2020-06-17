<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r25_dictamenes_eliminados".
 *
 * @property integer $r25_id
 * @property integer $c01_id
 * @property integer $c05_mvz
 * @property string $p03_fecha_dictamen_alta
 * @property string $p03_fecha_prueba
 * @property string $p03_folio
 * @property integer $p03_laboratorio
 * @property string $p03_liberado
 * @property integer $p03_tipo_prueba
 * @property integer $r01_id
 * @property integer $r25_tipo_dictamen
 * @property integer $r25_dictaminado
 * @property integer $r25_total_aretes
 * @property string $r25_motivo
 * @property integer $r25_usuElimina
 * @property string $r25_fechElimina
 */
class DictamenesEliminados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r25_dictamenes_eliminados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c01_id', 'c05_mvz', 'p03_laboratorio', 'p03_tipo_prueba', 'r01_id', 'r25_tipo_dictamen', 'r25_dictaminado', 'r25_total_aretes', 'r25_usuElimina', 'p03_folio'], 'integer'],
            [['p03_fecha_dictamen_alta', 'p03_fecha_prueba', 'r25_fechElimina'], 'safe'],
            [['p03_liberado'], 'string'],
            [['r25_motivo'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r25_id' => 'ID',
            'c01_id' => 'Productor',
            'c05_mvz' => 'Médico',
            'p03_fecha_dictamen_alta' => 'Fecha Dictamen Alta',
            'p03_fecha_prueba' => 'Fecha Prueba',
            'p03_folio' => 'Folio',
            'p03_laboratorio' => 'Laboratorio',
            'p03_liberado' => 'Liberado',
            'p03_tipo_prueba' => 'Tipo Prueba',
            'r01_id' => 'UPP',
            'r25_tipo_dictamen' => 'Tipo Dictamen',
            'r25_dictaminado' => 'Dictaminado',
            'r25_total_aretes' => 'Total Aretes',
            'r25_motivo' => 'Motivo',
            'r25_usuElimina' => 'Usuario que elimino',
            'r25_fechElimina' => 'Fecha de Eliminación',
        ];
    }
}
