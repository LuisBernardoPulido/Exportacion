<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ganaderos;

/**
 * GanaderosSearch represents the model behind the search form about `app\models\Ganaderos`.
 */
class GanaderosSearch extends Ganaderos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c01_id'], 'integer'],
            [['c01_nombre', 'c01_apaterno', 'c01_amaterno', 'c01_curp', 'c01_rfc', 'c01_telefono', 'c01_colonia', 'c01_calle', 'c01_cp', 'c01_localidad', 'c01_municipio', 'c01_estado', 'c01_correo'], 'safe'],
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
        $query = Ganaderos::find();

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
            'c01_id' => $this->c01_id,
        ]);

        $query->andFilterWhere(['like', 'c01_nombre', $this->c01_nombre])
            ->andFilterWhere(['like', 'c01_apaterno', $this->c01_apaterno])
            ->andFilterWhere(['like', 'c01_amaterno', $this->c01_amaterno])
            ->andFilterWhere(['like', 'c01_curp', $this->c01_curp])
            ->andFilterWhere(['like', 'c01_rfc', $this->c01_rfc])
            ->andFilterWhere(['like', 'c01_telefono', $this->c01_telefono])
            ->andFilterWhere(['like', 'c01_colonia', $this->c01_colonia])
            ->andFilterWhere(['like', 'c01_calle', $this->c01_calle])
            ->andFilterWhere(['like', 'c01_cp', $this->c01_cp])
            ->andFilterWhere(['like', 'c01_localidad', $this->c01_localidad])
            ->andFilterWhere(['=', 'c01_municipio', $this->c01_municipio])
            ->andFilterWhere(['=', 'c01_estado', $this->c01_estado])
            ->andFilterWhere(['like', 'c01_correo', $this->c01_correo]);

        return $dataProvider;
    }
}
