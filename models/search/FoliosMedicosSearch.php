<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoliosMedicos;

/**
 * FoliosMedicosSearch represents the model behind the search form about `app\models\FoliosMedicos`.
 */
class FoliosMedicosSearch extends FoliosMedicos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r16_id', 'c05_id', 'p03_id', 'r16_tipo_dictamen', 'r16_folio_asignado', 'r16_usuAlta', 'r16_usuMod'], 'integer'],
            [['r16_fecAlta', 'r16_fecMod'], 'safe'],
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
        $query = FoliosMedicos::find();

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
            'r16_id' => $this->r16_id,
            'c05_id' => $this->c05_id,
            'p03_id' => $this->p03_id,
            'r16_tipo_dictamen' => $this->r16_tipo_dictamen,
            'r16_folio_asignado' => $this->r16_folio_asignado,
            'r16_usuAlta' => $this->r16_usuAlta,
            'r16_fecAlta' => $this->r16_fecAlta,
            'r16_usuMod' => $this->r16_usuMod,
            'r16_fecMod' => $this->r16_fecMod,
        ]);

        return $dataProvider;
    }
}
