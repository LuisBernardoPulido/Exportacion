<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Folios;

/**
 * FoliosSearch represents the model behind the search form about `app\models\Folios`.
 */
class FoliosSearch extends Folios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r08_id', 'r08_folio', 'r08_usuMod'], 'integer'],
            [['r08_motivo', 'r08_fecMod'], 'safe'],
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
        $query = Folios::find();
        $query->orderBy('r08_fecAlta DESC');

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
            'r08_id' => $this->r08_id,
            'p03_br' => $this->p03_br,
            'p03_tb' => $this->p03_tb,
            'p03_vc' => $this->p03_vc,
            'r08_folio' => $this->r08_folio,
            'r08_usuAlta' => $this->r08_usuAlta,
            'r08_fecAlta' => $this->r08_fecAlta,
            'r08_usuMod' => $this->r08_usuMod,
            'r08_fecMod' => $this->r08_fecMod,
        ]);

        $query->andFilterWhere(['like', 'r08_motivo', $this->r08_motivo]);

        return $dataProvider;
    }
}
