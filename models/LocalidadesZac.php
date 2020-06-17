<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c04_localidades_zac".
 *
 * @property integer $c04_id
 * @property integer $c04_cve_ent
 * @property integer $c04_cve_mun
 * @property integer $c04_cve_loc
 * @property string $c04_nom_loc
 */
class LocalidadesZac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c04_localidades_zac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c04_cve_ent', 'c04_cve_mun', 'c04_cve_loc', 'c04_nom_loc'], 'required'],
            [['c04_cve_ent', 'c04_cve_mun', 'c04_cve_loc'], 'integer'],
            [['c04_nom_loc'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c04_id' => 'ID Localidad',
            'c04_cve_ent' => 'Clave entidad',
            'c04_cve_mun' => 'Clave municpio',
            'c04_cve_loc' => 'Clave Localidad',
            'c04_nom_loc' => 'Nombre',
        ];
    }

    public static  function getLocalidadesPorMun($edo, $mpo=NULL)
    {

        if ($mpo != NULL) {
            $temp = Municipios::findOne($mpo);

            $op = LocalidadesZac::find()->where('c04_cve_mun=:mpo', [':mpo' => $temp->c03_cve_mun])->andwhere('c04_cve_ent=:edo', [':edo' => $edo])->all();

            return ArrayHelper::map($op, 'c04_id', 'c04_nom_loc');
        }else{
            $op = LocalidadesZac::find()->where('c04_cve_mun=:mpo', [':mpo' => -1])->andwhere('c04_cve_ent=:edo', [':edo' => $edo])->all();

            return ArrayHelper::map($op, 'c04_id', 'c04_nom_loc');
        }
    }

    public static function getAllLocalidades() {
        $lista = LocalidadesZac::find()

            ->all();
        return ArrayHelper::map($lista, 'c04_id', function($model, $defaultValue) {
            return $model['c04_nom_loc'];
        });
    }
    
}
