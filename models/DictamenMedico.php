<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r03_aretes_medico_upp".
 *
 * @property integer $r03_id
 * @property string $r03_arete
 * @property string $r03_edad
 * @property integer $r03_raza
 * @property string $r03_sexo
 * @property string $r03_nsr
 * @property string $r03_frealizacion
 * @property integer $r03_noasignacion
 *
 * @property R03MedicoUpp $r03Noasignacion
 */
class DictamenMedico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r03_aretes_dictamen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r03_arete', 'r03_edad', 'r03_raza', 'r03_frealizacion'], 'required'],
            [['r03_raza', 'r03_noasignacion'], 'integer'],
            [['r03_sexo', 'r03_nsr'], 'string'],
            [['r03_frealizacion'], 'safe'],
            [['r03_arete', 'r03_edad'], 'string', 'max' => 50],
                [['r03_noasignacion'], 'exist', 'skipOnError' => true, 'targetClass' => AsignacionMedico::className(), 'targetAttribute' => ['r03_noasignacion' => 'r03_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r03_id' => 'ID Arete',
            'r03_arete' => 'Número de arete',
            'r03_edad' => 'Edad',
            'r03_raza' => 'Raza',
            'r03_sexo' => 'Sexo',
            'r03_nsr' => 'Diagnostico',
            'r03_frealizacion' => 'Fecha de realización',
            'r03_noasignacion' => 'Número de asignación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR03Noasignacion()
    {
        return $this->hasOne(R03MedicoUpp::className(), ['r03_id' => 'r03_noasignacion']);
    }

    public static function getDictamenes($id) {
        $todos = DictamenMedico::find()
            ->where('r03_noasignacion=:numero',[':numero'=>$id]);

        $dataprovider = new ActiveDataProvider([
            'query' => $todos,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
