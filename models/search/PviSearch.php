<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pvi;

/**
 * PviSearch represents the model behind the search form about `app\models\Pvi`.
 */
class PviSearch extends Pvi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c16_id'], 'integer'],
            [['c16_numero', 'c16_responsable', 'c16_telefono', 'c16_colonia', 'c16_calle', 'c16_cp', 'c16_localidad', 'c16_municipio', 'c16_estado', 'c16_email', 'c16_estatus'], 'safe'],
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
        $query = Pvi::find();

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
            'c16_id' => $this->c16_id,
        ]);

        $query->andFilterWhere(['like', 'c16_numero', $this->c16_numero])
            ->andFilterWhere(['like', 'c16_responsable', $this->c16_responsable])
            ->andFilterWhere(['like', 'c16_telefono', $this->c16_telefono])
            ->andFilterWhere(['like', 'c16_colonia', $this->c16_colonia])
            ->andFilterWhere(['like', 'c16_calle', $this->c16_calle])
            ->andFilterWhere(['like', 'c16_cp', $this->c16_cp])
            ->andFilterWhere(['like', 'c16_localidad', $this->c16_localidad])
            ->andFilterWhere(['like', 'c16_municipio', $this->c16_municipio])
            ->andFilterWhere(['like', 'c16_estado', $this->c16_estado])
            ->andFilterWhere(['like', 'c16_email', $this->c16_email])
            ->andFilterWhere(['like', 'c16_estatus', $this->c16_estatus]);

        return $dataProvider;
    }
}
