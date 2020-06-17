<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rastro;

/**
 * RastroSearch represents the model behind the search form about `app\models\Rastro`.
 */
class RastroSearch extends Rastro
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p08_id', 'r01_origen', 'r01_destino', 'c14_motivo', 'p08_usuAlta', 'p08_usuMod'], 'integer'],
            [['p08_num_rastro', 'p08_fecAlta', 'p08_fecMod'], 'safe'],
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
        $query = Rastro::find();

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
            'p08_id' => $this->p08_id,
            'r01_origen' => $this->r01_origen,
            'r01_destino' => $this->r01_destino,
            'c14_motivo' => $this->c14_motivo,
            'p08_usuAlta' => $this->p08_usuAlta,
            'p08_fecAlta' => $this->p08_fecAlta,
            'p08_usuMod' => $this->p08_usuMod,
            'p08_fecMod' => $this->p08_fecMod,
        ]);

        $query->andFilterWhere(['like', 'p08_num_rastro', $this->p08_num_rastro]);

        return $dataProvider;
    }
}
