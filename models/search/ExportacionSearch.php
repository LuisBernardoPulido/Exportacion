<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Exportacion;

/**
 * ExportacionSearch represents the model behind the search form about `app\models\Exportacion`.
 */
class ExportacionSearch extends Exportacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p11_id', 'p11_guia', 'r01_origen', 'r01_destino', 'c01_id', 'p11_motivo', 'p11_especie', 'p11_usuAlta', 'p11_usuMod'], 'integer'],
            [['p11_fecha', 'p11_aux', 'p11_fecAlta', 'p11_fecMod'], 'safe'],
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
        $query = Exportacion::find();

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
            'p11_id' => $this->p11_id,
            'p11_guia' => $this->p11_guia,
            'p11_fecha' => $this->p11_fecha,
            'r01_origen' => $this->r01_origen,
            'r01_destino' => $this->r01_destino,
            'c01_id' => $this->c01_id,
            'p11_motivo' => $this->p11_motivo,
            'p11_especie' => $this->p11_especie,
            'p11_usuAlta' => $this->p11_usuAlta,
            'p11_fecAlta' => $this->p11_fecAlta,
            'p11_usuMod' => $this->p11_usuMod,
            'p11_fecMod' => $this->p11_fecMod,
        ]);

        $query->andFilterWhere(['like', 'p11_aux', $this->p11_aux]);

        return $dataProvider;
    }
}
