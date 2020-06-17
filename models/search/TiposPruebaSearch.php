<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TiposPrueba;

/**
 * TiposPruebaSearch represents the model behind the search form about `app\models\TiposPrueba`.
 */
class TiposPruebaSearch extends TiposPrueba
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c08_id', 'c08_tipo'], 'integer'],
            [['c08_descripcion'], 'safe'],
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
        $query = TiposPrueba::find();

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
            'c08_id' => $this->c08_id,
            'c08_tipo' => $this->c08_tipo,
        ]);

        $query->andFilterWhere(['like', 'c08_descripcion', $this->c08_descripcion]);
        $query->andFilterWhere(['like', 'c08_tipo', $this->c08_tipo]);

        return $dataProvider;
    }
}
