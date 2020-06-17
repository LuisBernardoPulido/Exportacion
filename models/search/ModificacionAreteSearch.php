<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ModificacionArete;

/**
 * ModificacionAreteSearch represents the model behind the search form about `app\models\ModificacionArete`.
 */
class ModificacionAreteSearch extends ModificacionArete
{
    /**
     * @inheritdoc
     */

    public $fecha_desde;
    public $fecha_hasta;

    public function rules()
    {
        return [
            [['r22_id', 'r22_usuario_modifica', 'r02_id'], 'integer'],
            [['r02_numero_anterior', 'r02_edad_anterior', 'r02_raza_anterior', 'r02_raza2_anterior', 'r02_sexo_anterior', 'r02_especie_anterior', 'r02_fnacimiento_anterior', 'r02_numero_actual', 'r02_edad_actual', 'r02_raza_actual', 'r02_raza2_actual', 'r02_sexo_actual', 'r02_especie_actual', 'r02_fnacimiento_actual', 'r02_fecAlt','fecha_desde', 'fecha_hasta'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ModificacionArete::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'r22_id' => $this->r22_id,
            'r22_usuario_modifica' => $this->r22_usuario_modifica,
            'r02_id' => $this->r02_id,
            'r02_fnacimiento_anterior' => $this->r02_fnacimiento_anterior,
            'r02_fnacimiento_actual' => $this->r02_fnacimiento_actual,
            'r02_fecAlt' => $this->r02_fecAlt,
        ]);

        $query->andFilterWhere(['like', 'r02_numero_anterior', $this->r02_numero_anterior])
            ->andFilterWhere(['like', 'r02_edad_anterior', $this->r02_edad_anterior])
            ->andFilterWhere(['like', 'r02_raza_anterior', $this->r02_raza_anterior])
            ->andFilterWhere(['like', 'r02_raza2_anterior', $this->r02_raza2_anterior])
            ->andFilterWhere(['like', 'r02_sexo_anterior', $this->r02_sexo_anterior])
            ->andFilterWhere(['like', 'r02_especie_anterior', $this->r02_especie_anterior])
            ->andFilterWhere(['like', 'r02_numero_actual', $this->r02_numero_actual])
            ->andFilterWhere(['like', 'r02_edad_actual', $this->r02_edad_actual])
            ->andFilterWhere(['like', 'r02_raza_actual', $this->r02_raza_actual])
            ->andFilterWhere(['like', 'r02_raza2_actual', $this->r02_raza2_actual])
            ->andFilterWhere(['like', 'r02_sexo_actual', $this->r02_sexo_actual])
            ->andFilterWhere(['like', 'r02_especie_actual', $this->r02_especie_actual]);
        $query->andFilterWhere(['>=', 'r02_fecAlt', $this->fecha_desde]);
        $query->andFilterWhere(['<=', 'r02_fecAlt', $this->fecha_hasta]);

        return $dataProvider;
    }
}
