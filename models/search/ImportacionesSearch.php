<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Importaciones;

/**
 * ImportacionesSearch represents the model behind the search form about `app\models\Importaciones`.
 */
class ImportacionesSearch extends Importaciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r10_id', 'r10_tipo', 'r10_usuAlta'], 'integer'],
            [['r10_fecAlta'], 'safe'],
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
        $query = Importaciones::find();

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
            'r10_id' => $this->r10_id,
            'r10_tipo' => $this->r10_tipo,
            'r10_usuAlta' => $this->r10_usuAlta,
            'r10_fecAlta' => $this->r10_fecAlta,
        ]);

        return $dataProvider;
    }
}
