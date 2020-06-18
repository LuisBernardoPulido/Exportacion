<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Solicitudes;

/**
 * SolicitudesSearch represents the model behind the search form about `app\models\Solicitudes`.
 */
class SolicitudesSearch extends Solicitudes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p09_id', 'r01_id', 'p09_usuAlta', 'p09_usuMod'], 'integer'],
            [['p09_referencia', 'p09_fecAlta', 'p09_fecMod'], 'safe'],
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
        $query = Solicitudes::find();

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
            'p09_id' => $this->p09_id,
            'r01_id' => $this->r01_id,
            'p09_usuAlta' => $this->p09_usuAlta,
            'p09_fecAlta' => $this->p09_fecAlta,
            'p09_usuMod' => $this->p09_usuMod,
            'p09_fecMod' => $this->p09_fecMod,
        ]);

        $query->andFilterWhere(['like', 'p09_referencia', $this->p09_referencia]);

        return $dataProvider;
    }
}
