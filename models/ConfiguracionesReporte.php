<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r09_conf_reporte_usuario".
 *
 * @property integer $r08_id
 * @property integer $user
 * @property double $r08_left
 * @property double $r08_rigth
 * @property double $r08_up
 * @property double $r08_down
 * @property integer $r08_tipo
 *
 * @property Users $user0
 */
class ConfiguracionesReporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r09_conf_reporte_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user'], 'required'],
            [['user', 'r08_tipo'], 'integer'],
            [['r08_left', 'r08_rigth', 'r08_up', 'r08_down'], 'number'],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r08_id' => 'R08 ID',
            'user' => 'Usuario Perteneciente',
            'r08_left' => 'Left',
            'r08_rigth' => 'Rigth',
            'r08_up' => 'Up',
            'r08_down' => 'Down',
            'r08_tipo' => 'Tipo de Reporte',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Users::className(), ['id' => 'user']);
    }
    public static function getMargenes(){
       $margenes =  ConfiguracionesReporte::find()->where('user=:id', [':id'=>Yii::$app->user->getId()])->one();

       return $margenes;
    }
}
