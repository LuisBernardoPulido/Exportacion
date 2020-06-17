<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoliosAdministrador;

/**
 * FoliosAdministradorSearch represents the model behind the search form about `app\models\FoliosAdministrador`.
 */
class FoliosAdministradorSearch extends FoliosAdministrador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r21_id', 'user_role', 'r21_rangoInicio', 'r21_rangoFin', 'r21_usuAlta', 'r21_usuMod', 'r21_tipo_dictamen'], 'integer'],
            [['r21_fecAlta', 'r21_fecMod'], 'safe'],
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
        $query = FoliosAdministrador::find();

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
            'r21_id' => $this->r21_id,
            'user_role' => $this->user_role,
            'r21_rangoInicio' => $this->r21_rangoInicio,
            'r21_rangoFin' => $this->r21_rangoFin,
            'r21_usuAlta' => $this->r21_usuAlta,
            'r21_fecAlta' => $this->r21_fecAlta,
            'r21_usuMod' => $this->r21_usuMod,
            'r21_fecMod' => $this->r21_fecMod,
            'r21_tipo_dictamen' => $this->r21_tipo_dictamen,
        ]);

        return $dataProvider;
    }
}
