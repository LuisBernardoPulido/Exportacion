<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Parametros;

/**
 * ParametrosSearch represents the model behind the search form about `app\models\Parametros`.
 */
class ParametrosSearch extends Parametros
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p05_id', 'p05_tipo', 'p05_activo', 'p05_usuAlta', 'p05_usuMod'], 'integer'],
            [['p05_nombre', 'p05_valor', 'p05_fecAlta', 'p05_fecMod'], 'safe'],
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
        $query = Parametros::find();

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
            'p05_id' => $this->p05_id,
            'p05_tipo' => $this->p05_tipo,
            'p05_activo' => $this->p05_activo,
            'p05_usuAlta' => $this->p05_usuAlta,
            'p05_fecAlta' => $this->p05_fecAlta,
            'p05_usuMod' => $this->p05_usuMod,
            'p05_fecMod' => $this->p05_fecMod,
        ]);

        $query->andFilterWhere(['like', 'p05_nombre', $this->p05_nombre])
            ->andFilterWhere(['like', 'p05_valor', $this->p05_valor]);

        return $dataProvider;
    }
}
