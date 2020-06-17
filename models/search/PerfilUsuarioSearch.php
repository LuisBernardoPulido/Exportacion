<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PerfilUsuario;

/**
 * PerfilUsuarioSearch represents the model behind the search form about `app\models\PerfilUsuario`.
 */
class PerfilUsuarioSearch extends PerfilUsuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a02_id', 'a01_id', 'a02_activo', 'a02_intentos', 'a02_islab', 'a02_usuAlta', 'a02_usuMod'], 'integer'],
            [['a02_nombre', 'a02_apaterno', 'a02_amaterno', 'a02_email', 'a02_telfono', 'a02_direccion', 'a02_fecAlta', 'a02_fecMod'], 'safe'],
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
        $query = PerfilUsuario::find();

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
            'a02_id' => $this->a02_id,
            'a01_id' => $this->a01_id,
            'a02_activo' => $this->a02_activo,
            'a02_intentos' => $this->a02_intentos,
            'a02_islab' => $this->a02_islab,
            'a02_usuAlta' => $this->a02_usuAlta,
            'a02_fecAlta' => $this->a02_fecAlta,
            'a02_usuMod' => $this->a02_usuMod,
            'a02_fecMod' => $this->a02_fecMod,
        ]);

        $query->andFilterWhere(['like', 'a02_nombre', $this->a02_nombre])
            ->andFilterWhere(['like', 'a02_apaterno', $this->a02_apaterno])
            ->andFilterWhere(['like', 'a02_amaterno', $this->a02_amaterno])
            ->andFilterWhere(['like', 'a02_email', $this->a02_email])
            ->andFilterWhere(['like', 'a02_telfono', $this->a02_telfono])
            ->andFilterWhere(['like', 'a02_direccion', $this->a02_direccion]);

        return $dataProvider;
    }
}
