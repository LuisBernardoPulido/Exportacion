<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Garrapatas;

/**
 * GarrapatasSearch represents the model behind the search form about `app\models\Garrapatas`.
 */
class GarrapatasSearch extends Garrapatas
{
    /**
     * @inheritdoc
     */
    public $fecha_desde;
    public $fecha_hasta;
    public function rules()
    {
        return [
            [['p03_id', 'c01_id', 'r01_id', 'p03_cal_banado', 'c17_id', 'p03_capacidad', 'p03_cant_bov', 'p03_cant_eq', 'p03_cant_capr', 'p03_cant_ov', 'p03_cant_otros', 'c07_id'], 'integer'],
            [['p03_domicilio', 'r01_municipio', 'r01_estado', 'p03_fec_ult_trata', 'p03_destino', 'p03_municipio', 'p03_estado', 'p03_ruta1', 'p03_ruta2', 'p03_ruta3', 'p03_transporte', 'p03_marca', 'p03_placas', 'p03_flejado', 'p03_fec_exp', 'p03_lugar_exp', 'p03_fec_venc', 'p03_exp_nombre', 'p03_exp_rfc', 'p03_exp_cargo', 'p03_avalado_nombre', 'p03_observaciones','fecha_desde','fecha_hasta','p03_folio'], 'safe'],
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
        $query = Garrapatas::find();

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
            'p03_id' => $this->p03_id,
            'c01_id' => $this->c01_id,
            'r01_id' => $this->r01_id,
            'p03_cal_banado' => $this->p03_cal_banado,
            'p03_fec_ult_trata' => $this->p03_fec_ult_trata,
            'c17_id' => $this->c17_id,
            'p03_capacidad' => $this->p03_capacidad,
            'p03_cant_bov' => $this->p03_cant_bov,
            'p03_cant_eq' => $this->p03_cant_eq,
            'p03_cant_capr' => $this->p03_cant_capr,
            'p03_cant_ov' => $this->p03_cant_ov,
            'p03_cant_otros' => $this->p03_cant_otros,
            'c07_id' => $this->c07_id,
            'p03_fec_exp' => $this->p03_fec_exp,
            'p03_fec_venc' => $this->p03_fec_venc,
        ]);

        $query->andFilterWhere(['like', 'p03_domicilio', $this->p03_domicilio])
            ->andFilterWhere(['like', 'r01_municipio', $this->r01_municipio])
            ->andFilterWhere(['like', 'r01_estado', $this->r01_estado])
            ->andFilterWhere(['like', 'p03_destino', $this->p03_destino])
            ->andFilterWhere(['like', 'p03_municipio', $this->p03_municipio])
            ->andFilterWhere(['like', 'p03_estado', $this->p03_estado])
            ->andFilterWhere(['like', 'p03_ruta1', $this->p03_ruta1])
            ->andFilterWhere(['like', 'p03_ruta2', $this->p03_ruta2])
            ->andFilterWhere(['like', 'p03_ruta3', $this->p03_ruta3])
            ->andFilterWhere(['like', 'p03_transporte', $this->p03_transporte])
            ->andFilterWhere(['like', 'p03_marca', $this->p03_marca])
            ->andFilterWhere(['like', 'p03_placas', $this->p03_placas])
            ->andFilterWhere(['like', 'p03_flejado', $this->p03_flejado])
            ->andFilterWhere(['like', 'p03_lugar_exp', $this->p03_lugar_exp])
            ->andFilterWhere(['like', 'p03_exp_nombre', $this->p03_exp_nombre])
            ->andFilterWhere(['like', 'p03_exp_rfc', $this->p03_exp_rfc])
            ->andFilterWhere(['like', 'p03_exp_cargo', $this->p03_exp_cargo])
            ->andFilterWhere(['like', 'p03_avalado_nombre', $this->p03_avalado_nombre])
            ->andFilterWhere(['like', 'p03_observaciones', $this->p03_observaciones])
            ->andFilterWhere(['like', 'p03_folio', $this->p03_folio]);

        $query->andFilterWhere(['>=', 'p03_fec_exp', $this->fecha_desde]);
        $query->andFilterWhere(['<=', 'p03_fec_exp', $this->fecha_hasta]);

        return $dataProvider;
    }
}
