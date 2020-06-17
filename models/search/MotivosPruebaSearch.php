<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MotivosPrueba;

/**
 * MotivosPruebaSearch represents the model behind the search form about `app\models\MotivosPrueba`.
 */
class MotivosPruebaSearch extends MotivosPrueba
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c07_id', 'c07_tipo'], 'integer'],
            [['c07_descripcion'], 'safe'],
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
        $query = MotivosPrueba::find();

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
            'c07_id' => $this->c07_id,
            'c07_tipo' => $this->c07_tipo,
        ]);

        $query->andFilterWhere(['like', 'c07_descripcion', $this->c07_descripcion]);
        $query->andFilterWhere(['like', 'c07_tipo', $this->c07_tipo]);

        return $dataProvider;
    }
}
