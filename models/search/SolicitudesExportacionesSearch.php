<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SolicitudesExportaciones;

/**
 * SolicitudesExportacionesSearch represents the model behind the search form about `app\models\SolicitudesExportaciones`.
 */
class SolicitudesExportacionesSearch extends SolicitudesExportaciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p12_id', 'p12_sexo', 'p12_usuAlta', 'p12_usuMod'], 'integer'],
            [['p12_aux', 'p12_aux2', 'p12_fecAlta', 'p12_fecMod'], 'safe'],
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
        $query = SolicitudesExportaciones::find();

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
            'p12_id' => $this->p12_id,
            'p12_sexo' => $this->p12_sexo,
            'p12_usuAlta' => $this->p12_usuAlta,
            'p12_fecAlta' => $this->p12_fecAlta,
            'p12_usuMod' => $this->p12_usuMod,
            'p12_fecMod' => $this->p12_fecMod,
        ]);

        $query->andFilterWhere(['like', 'p12_aux', $this->p12_aux])
            ->andFilterWhere(['like', 'p12_aux2', $this->p12_aux2]);

        return $dataProvider;
    }
}
