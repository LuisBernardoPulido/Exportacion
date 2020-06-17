<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c14_motivo_remo".
 *
 * @property integer $c14_id
 * @property string $c14_descrip
 * @property string $c14_descrip2
 *
 * @property P04RegistroMovilidad[] $p04RegistroMovilidads
 */
class MotivoRemo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c14_motivo_remo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c14_descrip'], 'required'],
            [['c14_descrip', 'c14_descrip2'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c14_id' => 'C14 ID',
            'c14_descrip' => 'Descripción',
            'c14_descrip2' => 'Descripción 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP04RegistroMovilidads()
    {
        return $this->hasMany(RegistroMovilidad::className(), ['c14_motivo' => 'c14_id']);
    }

    public static function getAllMotivos(){
        $motivos = MotivoRemo::find()->where('c14_id!=0')->all();

        return ArrayHelper::map($motivos, 'c14_id', 'c14_descrip');
    }
}
