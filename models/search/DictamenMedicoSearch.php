<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DictamenMedico;

/**
 * DictamenMedicoSearch represents the model behind the search form about `app\models\DictamenMedico`.
 */
class DictamenMedicoSearch extends DictamenMedico
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r03_id', 'r03_raza', 'r03_noasignacion'], 'integer'],
            [['r03_arete', 'r03_edad', 'r03_sexo', 'r03_nsr', 'r03_frealizacion'], 'safe'],
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
    public function search($params, $id)
    {
        $query = DictamenMedico::find()->where('r03_noasignacion=:id', [':id'=>$id]);

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
            'r03_id' => $this->r03_id,
            'r03_raza' => $this->r03_raza,
            'r03_frealizacion' => $this->r03_frealizacion,
            'r03_noasignacion' => $this->r03_noasignacion,
        ]);

        $query->andFilterWhere(['like', 'r03_arete', $this->r03_arete])
            ->andFilterWhere(['like', 'r03_edad', $this->r03_edad])
            ->andFilterWhere(['like', 'r03_sexo', $this->r03_sexo])
            ->andFilterWhere(['like', 'r03_nsr', $this->r03_nsr]);

        return $dataProvider;
    }
}
