<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DictamenesAretes;

/**
 * DictamenesAretesSearch represents the model behind the search form about `app\models\DictamenesAretes`.
 */
class DictamenesAretesSearch extends DictamenesAretes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r03_id', 'r02_id', 'r03_asignacion'], 'integer'],
            [['r03_tipo', 'r03_diagnostivo', 'r03_resultado', 'r03_frealizacion'], 'safe'],
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
        $query = DictamenesAretes::find();

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
            'r03_id' => $this->r03_id,
            'r02_id' => $this->r02_id,
            'r03_frealizacion' => $this->r03_frealizacion,
            'r03_asignacion' => $this->r03_asignacion,
        ]);

        $query->andFilterWhere(['like', 'r03_tipo', $this->r03_tipo])
            ->andFilterWhere(['like', 'r03_diagnostivo', $this->r03_diagnostivo])
            ->andFilterWhere(['like', 'r03_resultado', $this->r03_resultado]);

        return $dataProvider;
    }
}
