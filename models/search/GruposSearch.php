<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Grupos;

/**
 * GruposSearch represents the model behind the search form about `app\models\Grupos`.
 */
class GruposSearch extends Grupos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p07_id', 'p07_usuAlta', 'p07_usuMod'], 'integer'],
            [['p07_nombre', 'p07_descripcion', 'p07_fecAlta', 'p07_fecMod'], 'safe'],
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
        $query = Grupos::find();

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
            'p07_id' => $this->p07_id,
            'p07_usuAlta' => $this->p07_usuAlta,
            'p07_fecAlta' => $this->p07_fecAlta,
            'p07_usuMod' => $this->p07_usuMod,
            'p07_fecMod' => $this->p07_fecMod,
        ]);

        $query->andFilterWhere(['like', 'p07_nombre', $this->p07_nombre])
            ->andFilterWhere(['like', 'p07_descripcion', $this->p07_descripcion]);

        return $dataProvider;
    }
}
