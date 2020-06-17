<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DictamenesEliminados;

/**
 * DictamenesEliminadosSearch represents the model behind the search form about `app\models\DictamenesEliminados`.
 */
class DictamenesEliminadosSearch extends DictamenesEliminados
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r25_id', 'c01_id', 'c05_mvz', 'p03_laboratorio', 'p03_tipo_prueba', 'r01_id', 'r25_tipo_dictamen', 'r25_dictaminado', 'r25_total_aretes', 'r25_usuElimina'], 'integer'],
            [['p03_fecha_dictamen_alta', 'p03_fecha_prueba', 'p03_folio', 'p03_liberado', 'r25_motivo', 'r25_fechElimina'], 'safe'],
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
        $query = DictamenesEliminados::find();

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
            'r25_id' => $this->r25_id,
            'c01_id' => $this->c01_id,
            'c05_mvz' => $this->c05_mvz,
            'p03_fecha_dictamen_alta' => $this->p03_fecha_dictamen_alta,
            'p03_fecha_prueba' => $this->p03_fecha_prueba,
            'p03_laboratorio' => $this->p03_laboratorio,
            'p03_tipo_prueba' => $this->p03_tipo_prueba,
            'r01_id' => $this->r01_id,
            'r25_tipo_dictamen' => $this->r25_tipo_dictamen,
            'r25_dictaminado' => $this->r25_dictaminado,
            'r25_total_aretes' => $this->r25_total_aretes,
            'r25_usuElimina' => $this->r25_usuElimina,
            'r25_fechElimina' => $this->r25_fechElimina,
        ]);

        $query->andFilterWhere(['like', 'p03_folio', $this->p03_folio])
            ->andFilterWhere(['like', 'p03_liberado', $this->p03_liberado])
            ->andFilterWhere(['like', 'r25_motivo', $this->r25_motivo]);


        return $dataProvider;
    }
}
