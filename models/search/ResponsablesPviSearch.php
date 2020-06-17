<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ResponsablesPvi;

/**
 * ResponsablesPviSearch represents the model behind the search form about `app\models\ResponsablesPvi`.
 */
class ResponsablesPviSearch extends ResponsablesPvi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c17_id'], 'integer'],
            [['c17_clave', 'c17_nombre', 'c17_apaterno', 'c17_amaterno', 'c17_nombre_completo', 'c17_rfc', 'c17_telefono', 'c17_colonia', 'c17_calle', 'c17_cp', 'c17_localidad', 'c17_municipio', 'c17_estado', 'c17_correo', 'c17_estatus'], 'safe'],
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
        $query = ResponsablesPvi::find();

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
            'c17_id' => $this->c17_id,
        ]);

        $query->andFilterWhere(['like', 'c17_clave', $this->c17_clave])
            ->andFilterWhere(['like', 'c17_nombre', $this->c17_nombre])
            ->andFilterWhere(['like', 'c17_apaterno', $this->c17_apaterno])
            ->andFilterWhere(['like', 'c17_amaterno', $this->c17_amaterno])
            ->andFilterWhere(['like', 'c17_nombre_completo', $this->c17_nombre_completo])
            ->andFilterWhere(['like', 'c17_rfc', $this->c17_rfc])
            ->andFilterWhere(['like', 'c17_telefono', $this->c17_telefono])
            ->andFilterWhere(['like', 'c17_colonia', $this->c17_colonia])
            ->andFilterWhere(['like', 'c17_calle', $this->c17_calle])
            ->andFilterWhere(['like', 'c17_cp', $this->c17_cp])
            ->andFilterWhere(['like', 'c17_localidad', $this->c17_localidad])
            ->andFilterWhere(['like', 'c17_municipio', $this->c17_municipio])
            ->andFilterWhere(['like', 'c17_estado', $this->c17_estado])
            ->andFilterWhere(['like', 'c17_correo', $this->c17_correo])
            ->andFilterWhere(['like', 'c17_estatus', $this->c17_estatus]);

        return $dataProvider;
    }
}
