<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r24_asignacion_ultimo_arete".
 *
 * @property integer $id
 * @property string $r24_arete
 */
class AsignacionUltimoArete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r24_asignacion_ultimo_arete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['r24_arete'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'r24_arete' => 'R24 Arete',
        ];
    }
}
