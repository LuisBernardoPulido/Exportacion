<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Razas;

/**
 * RazasSearch represents the model behind the search form about `app\models\Razas`.
 */
class RazasSearch extends Razas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c06_id', 'c06_activo'], 'integer'],
            [['c06_raza', 'c06_especie', 'c06_clave'], 'safe'],
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
        $query = Razas::find();

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
            'c06_id' => $this->c06_id,
            'c06_activo' => $this->c06_activo,
        ]);

        $query->andFilterWhere(['like', 'c06_raza', $this->c06_raza])
            ->andFilterWhere(['like', 'c06_especie', $this->c06_especie])
            ->andFilterWhere(['like', 'c06_clave', $this->c06_clave]);

        return $dataProvider;
    }
}
