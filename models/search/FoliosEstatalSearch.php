<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoliosEstatal;

/**
 * FoliosEstatalSearch represents the model behind the search form about `app\models\FoliosEstatal`.
 */
class FoliosEstatalSearch extends FoliosEstatal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r20_id', 'user_role', 'r20_rangoInicio', 'r20_rangoFin', 'r20_usuAlta', 'r20_usuMod', 'r20_tipo_dictamen'], 'integer'],
            [['r20_fecAlta', 'r20_fecMod'], 'safe'],
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
        $query = FoliosEstatal::find();

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
            'r20_id' => $this->r20_id,
            'user_role' => $this->user_role,
            'r20_rangoInicio' => $this->r20_rangoInicio,
            'r20_rangoFin' => $this->r20_rangoFin,
            'r20_usuAlta' => $this->r20_usuAlta,
            'r20_fecAlta' => $this->r20_fecAlta,
            'r20_usuMod' => $this->r20_usuMod,
            'r20_fecMod' => $this->r20_fecMod,
            'r20_tipo_dictamen' => $this->r20_tipo_dictamen,
        ]);

        return $dataProvider;
    }
}
