<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SeleccionPreviaAretes;

/**
 * SeleccionPreviaAretesSearch represents the model behind the search form about `app\models\SeleccionPreviaAretes`.
 */
class SeleccionPreviaAretesSearch extends SeleccionPreviaAretes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r05_id', 'p02_id', 'r02_id', 'r05_tb', 'r05_br', 'r05_vc', 'r05_gr','r05_usuAlta'], 'integer'],
            [['r05_fecAlta'], 'safe'],
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
        $query = SeleccionPreviaAretes::find();

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
            //'r05_id' => $this->r05_id,
            //'p02_id' => $this->p02_id,
            'r02_id' => $this->r02_id,
            //'r05_tb' => $this->r05_tb,
            //'r05_br' => $this->r05_br,
            //'r05_vc' => $this->r05_vc,
            //'r05_usuAlta' => $this->r05_usuAlta,
            //'r05_fecAlta' => $this->r05_fecAlta,
        ]);

        return $dataProvider;
    }
}
