<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "p07_grupos".
 *
 * @property integer $p07_id
 * @property string $p07_nombre
 * @property string $p07_descripcion
 * @property integer $p07_usuAlta
 * @property string $p07_fecAlta
 * @property integer $p07_usuMod
 * @property string $p07_fecMod
 *
 * @property R13GruposUsuarios[] $r13GruposUsuarios
 */
class Grupos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p07_grupos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p07_usuAlta', 'p07_usuMod'], 'integer'],
            [['p07_fecAlta', 'p07_fecMod'], 'safe'],
            [['p07_nombre', 'p07_descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p07_id' => 'ID Grupo',
            'p07_nombre' => 'Nombre Grupo',
            'p07_descripcion' => 'Descripción',
            'p07_usuAlta' => 'Usuario Alta',
            'p07_fecAlta' => 'Fecha Alta',
            'p07_usuMod' => 'Usuario Modificación',
            'p07_fecMod' => 'Fecha de Modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR13GruposUsuarios()
    {
        return $this->hasMany(R13GruposUsuarios::className(), ['p07_id' => 'p07_id']);
    }

    public static function getUsuarios(){
        $grupos = GruposUsuarios::find()->where('a01_id=:user', [':user'=>Yii::$app->user->getId()]);

        $grupos_all = GruposUsuarios::find();
        if($grupos->count()>0){
            $contador=0;
            foreach ($grupos->all() as $gr){
                if($contador==0){
                    $grupos_all->where('p07_id=:ide', [':ide'=>$gr->p07_id]);
                }else{
                    $grupos_all->orFilterWhere(['=', 'p07_id', $gr->p07_id]);
                }
                $contador++;

            }
        }else{
            $grupos_all->where('p07_id=:ide', [':ide'=>-1]);
        }



        return $grupos_all;
    }
}
