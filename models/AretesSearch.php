<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aretes;

/**
 * AretesSearch represents the model behind the search form about `app\models\Aretes`.
 */
class AretesSearch extends Aretes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r02_id', 'r01_id', 'r02_especie', 'r02_mostrar', 'p01_id', 'p01_isfechadefinitiva', 'p01_upp_anterior', 'r02_especie_ant', 'r02_usuAlta', 'r02_usuMod'], 'integer'],
            [['r02_numero', 'r02_edad', 'r02_raza', 'r02_raza2', 'r02_sexo', 'r02_fierro', 'r02_fnacimiento', 'Empadre', 'r02_edad_ant', 'r02_raza_ant', 'r02_raza2_ant', 'r02_sexo_ant', 'r02_fecAlta', 'r02_fecMod'], 'safe'],
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
        $query = Aretes::find();

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
            'r02_id' => $this->r02_id,
            'r01_id' => $this->r01_id,
            'r02_fnacimiento' => $this->r02_fnacimiento,
            'r02_especie' => $this->r02_especie,
            'r02_mostrar' => $this->r02_mostrar,
            'p01_id' => $this->p01_id,
            'p01_isfechadefinitiva' => $this->p01_isfechadefinitiva,
            'p01_upp_anterior' => $this->p01_upp_anterior,
            'r02_especie_ant' => $this->r02_especie_ant,
            'r02_usuAlta' => $this->r02_usuAlta,
            'r02_fecAlta' => $this->r02_fecAlta,
            'r02_usuMod' => $this->r02_usuMod,
            'r02_fecMod' => $this->r02_fecMod,
        ]);

        $query->andFilterWhere(['like', 'r02_numero', $this->r02_numero])
            ->andFilterWhere(['like', 'r02_edad', $this->r02_edad])
            ->andFilterWhere(['like', 'r02_raza', $this->r02_raza])
            ->andFilterWhere(['like', 'r02_raza2', $this->r02_raza2])
            ->andFilterWhere(['like', 'r02_sexo', $this->r02_sexo])
            ->andFilterWhere(['like', 'r02_fierro', $this->r02_fierro])
            ->andFilterWhere(['like', 'Empadre', $this->Empadre])
            ->andFilterWhere(['like', 'r02_edad_ant', $this->r02_edad_ant])
            ->andFilterWhere(['like', 'r02_raza_ant', $this->r02_raza_ant])
            ->andFilterWhere(['like', 'r02_raza2_ant', $this->r02_raza2_ant])
            ->andFilterWhere(['like', 'r02_sexo_ant', $this->r02_sexo_ant]);

        return $dataProvider;
    }
}
