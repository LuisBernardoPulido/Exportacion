<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rutas;

/**
 * RutasSearch represents the model behind the search form about `app\models\Rutas`.
 */
class RutasSearch extends Rutas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c18_id', 'c18_usuAlta', 'c18_usuMod'], 'integer'],
            [['c18_nombre', 'c18_clave', 'c18_municipio', 'c18_estado', 'c18_ruta1', 'c18_ruta2', 'c18_ruta3', 'c18_fecAlta', 'c18_fecMod', 'c18_estatus'], 'safe'],
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
        $query = Rutas::find();

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
            'c18_id' => $this->c18_id,
            'c18_usuAlta' => $this->c18_usuAlta,
            'c18_fecAlta' => $this->c18_fecAlta,
            'c18_usuMod' => $this->c18_usuMod,
            'c18_fecMod' => $this->c18_fecMod,
        ]);

        $query->andFilterWhere(['like', 'c18_nombre', $this->c18_nombre])
            ->andFilterWhere(['like', 'c18_clave', $this->c18_clave])
            ->andFilterWhere(['like', 'c18_municipio', $this->c18_municipio])
            ->andFilterWhere(['like', 'c18_estado', $this->c18_estado])
            ->andFilterWhere(['like', 'c18_ruta1', $this->c18_ruta1])
            ->andFilterWhere(['like', 'c18_ruta2', $this->c18_ruta2])
            ->andFilterWhere(['like', 'c18_ruta3', $this->c18_ruta3])
            ->andFilterWhere(['like', 'c18_estatus', $this->c18_estatus]);

        return $dataProvider;
    }
}
