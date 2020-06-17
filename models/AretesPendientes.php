<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r14_aretes_pendientes".
 *
 * @property integer $r14_id
 * @property integer $r02_id
 * @property integer $user_original
 * @property integer $user_nuevo
 * @property integer $r14_usuAlta
 * @property string $r14_fecAlta
 * @property integer $r14_usuMod
 * @property string $r14_fecMod
 *
 * @property R02Aretes $r02
 * @property Users $userOriginal
 * @property Users $userNuevo
 */
class AretesPendientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r14_aretes_pendientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r02_id', 'user_original', 'user_nuevo'], 'required'],
            [['r02_id', 'user_original', 'user_nuevo', 'r14_usuAlta', 'r14_usuMod'], 'integer'],
            [['r14_fecAlta', 'r14_fecMod'], 'safe'],
            [['r02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aretes::className(), 'targetAttribute' => ['r02_id' => 'r02_id']],
            [['user_original'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_original' => 'id']],
            [['user_nuevo'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_nuevo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r14_id' => 'ID Registro',
            'r02_id' => 'ID Arete',
            'user_original' => 'Usuario Original',
            'user_nuevo' => 'Usuario Nuevo',
            'r14_usuAlta' => 'Usuario Alta',
            'r14_fecAlta' => 'Fecha de Alta',
            'r14_usuMod' => 'Usuario de Modificación',
            'r14_fecMod' => 'Fecha de Modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR02()
    {
        return $this->hasOne(R02Aretes::className(), ['r02_id' => 'r02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOriginal()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_original']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNuevo()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_nuevo']);
    }
}
