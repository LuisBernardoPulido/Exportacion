<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r13_grupos_usuarios".
 *
 * @property integer $r13_id
 * @property integer $a01_id
 * @property integer $p07_id
 * @property integer $r13_usuAlta
 * @property string $r13_fecAlta
 * @property integer $r13_usuMod
 * @property string $r13_fecMod
 *
 * @property Users $a01
 * @property P07Grupos $p07
 */
class GruposUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r13_grupos_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a01_id'], 'required'],
            [['a01_id', 'p07_id', 'r13_usuAlta', 'r13_usuMod'], 'integer'],
            [['r13_fecAlta', 'r13_fecMod'], 'safe'],
            [['a01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['a01_id' => 'id']],
            [['p07_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grupos::className(), 'targetAttribute' => ['p07_id' => 'p07_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r13_id' => 'ID Registro',
            'a01_id' => 'Usuario',
            'p07_id' => 'Grupo',
            'r13_usuAlta' => 'Usuario Alta',
            'r13_fecAlta' => 'Fecha Alta',
            'r13_usuMod' => 'Usuario Modificación',
            'r13_fecMod' => 'Fecha de Modificación',
        ];
    }
    public static function getRelacionesNulas(){
        $rel = GruposUsuarios::find()
            ->where('p07_id is NULL');

        $dataprovider = new ActiveDataProvider([
            'query' => $rel,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getA01()
    {
        return $this->hasOne(Users::className(), ['id' => 'a01_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP07()
    {
        return $this->hasOne(P07Grupos::className(), ['p07_id' => 'p07_id']);
    }
    public static function getUsuariosPorGrupo($id){
        $rel = GruposUsuarios::find()
            ->where('p07_id=:activo',[':activo'=>$id]);

        $dataprovider = new ActiveDataProvider([
            'query' => $rel,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
