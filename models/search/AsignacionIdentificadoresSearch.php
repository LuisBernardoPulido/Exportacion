<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AsignacionIdentificadores;

/**
 * AsignacionIdentificadoresSearch represents the model behind the search form about `app\models\AsignacionIdentificadores`.
 */
class AsignacionIdentificadoresSearch extends AsignacionIdentificadores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r23_id', 'r01_id', 'c01_id', 'r23_especie', 'r23_usuAlta', 'r23_usuMod'], 'integer'],
            [['r23_motivo', 'r23_nombre_recibe', 'r23_celular', 'r23_codigo_postal', 'r23_calle', 'r23_estado', 'r23_ciudad', 'r23_colonia', 'r23_info_adicional', 'r23_fecAlta', 'r23_FecMod'], 'safe'],
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
        $query = AsignacionIdentificadores::find();

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
            'r23_id' => $this->r23_id,
            'r01_id' => $this->r01_id,
            'c01_id' => $this->c01_id,
            'r23_especie' => $this->r23_especie,
            'r23_usuAlta' => $this->r23_usuAlta,
            'r23_fecAlta' => $this->r23_fecAlta,
            'r23_usuMod' => $this->r23_usuMod,
            'r23_FecMod' => $this->r23_FecMod,
        ]);

        $query->andFilterWhere(['like', 'r23_motivo', $this->r23_motivo])
            ->andFilterWhere(['like', 'r23_nombre_recibe', $this->r23_nombre_recibe])
            ->andFilterWhere(['like', 'r23_celular', $this->r23_celular])
            ->andFilterWhere(['like', 'r23_codigo_postal', $this->r23_codigo_postal])
            ->andFilterWhere(['like', 'r23_calle', $this->r23_calle])
            ->andFilterWhere(['like', 'r23_estado', $this->r23_estado])
            ->andFilterWhere(['like', 'r23_ciudad', $this->r23_ciudad])
            ->andFilterWhere(['like', 'r23_colonia', $this->r23_colonia])
            ->andFilterWhere(['like', 'r23_info_adicional', $this->r23_info_adicional]);

        return $dataProvider;
    }
}
