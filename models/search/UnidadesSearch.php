<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Upp;

/**
 * UnidadesSearch represents the model behind the search form about `app\models\Upp`.
 */
class UnidadesSearch extends Upp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r01_id', 'r01_mostrar', 'r01_usuAlta', 'r01_usuMod'], 'integer'],
            [['r01_nombre', 'r01_superficie', 'r01_clave', 'r01_localidad', 'r01_municipio', 'r01_estado', 'r01_faretado', 'r01_tenencia', 'r01_fecAlta', 'r01_fecMod'], 'safe'],
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
        $query = Upp::find()->where('r01_mostrar!=:activo', [':activo'=>-1]);

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
            'r01_id' => $this->r01_id,
            'r01_mostrar' => $this->r01_mostrar,
            'r01_usuAlta' => $this->r01_usuAlta,
            'r01_fecAlta' => $this->r01_fecAlta,
            'r01_usuMod' => $this->r01_usuMod,
            'r01_fecMod' => $this->r01_fecMod,
        ]);

        $query->andFilterWhere(['like', 'r01_nombre', $this->r01_nombre])
            ->andFilterWhere(['like', 'r01_superficie', $this->r01_superficie])
            ->andFilterWhere(['like', 'r01_clave', $this->r01_clave])
            ->andFilterWhere(['like', 'r01_localidad', $this->r01_localidad])
            ->andFilterWhere(['like', 'r01_municipio', $this->r01_municipio])
            ->andFilterWhere(['like', 'r01_estado', $this->r01_estado])
            ->andFilterWhere(['like', 'r01_faretado', $this->r01_faretado])
            ->andFilterWhere(['like', 'r01_tenencia', $this->r01_tenencia]);

        return $dataProvider;
    }
}
