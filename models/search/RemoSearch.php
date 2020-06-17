<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Remo;

/**
 * RemoSearch represents the model behind the search form about `app\models\Remo`.
 */
class RemoSearch extends Remo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p04_id', 'r01_origen', 'r01_destino', 'r02_id', 'c14_motivo', 'p04_usuAlta', 'p04_usuMod'], 'integer'],
            [['p04_fecAlta', 'p04_fecMod'], 'safe'],
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
        $query = Remo::find();

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
            'p04_id' => $this->p04_id,
            'r01_origen' => $this->r01_origen,
            'r01_destino' => $this->r01_destino,
            'r02_id' => $this->r02_id,
            'c14_motivo' => $this->c14_motivo,
            'p04_usuAlta' => $this->p04_usuAlta,
            'p04_fecAlta' => $this->p04_fecAlta,
            'p04_usuMod' => $this->p04_usuMod,
            'p04_fecMod' => $this->p04_fecMod,
        ]);

        return $dataProvider;
    }
}
