<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Anexo;

/**
 * AnexoSearch represents the model behind the search form about `app\models\Anexo`.
 */
class AnexoSearch extends Anexo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c20_id', 'c19_id'], 'integer'],
            [['c20_nombre', 'c20_estatus'], 'safe'],
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
        $query = Anexo::find();

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
            'c20_id' => $this->c20_id,
            'c19_id' => $this->c19_id,
        ]);

        $query->andFilterWhere(['like', 'c20_nombre', $this->c20_nombre])
            ->andFilterWhere(['like', 'c20_estatus', $this->c20_estatus]);

        return $dataProvider;
    }
}
