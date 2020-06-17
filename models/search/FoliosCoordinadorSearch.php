<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoliosCoordinador;
use app\models\User;

/**
 * FoliosCoordinadorSearch represents the model behind the search form about `app\models\FoliosCoordinador`.
 */
class FoliosCoordinadorSearch extends FoliosCoordinador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r17_id', 'c05_id', 'r17_rangoInicio', 'r17_rangoFin', 'r17_usuAlta', 'r17_usuMod', 'r17_tipo_dictamen'], 'integer'],
            [['r17_fecAlta', 'r17_fecMod'], 'safe'],
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
        if(User::isUserAdmin(Yii::$app->user->getId())){
            $query = FoliosCoordinador::find();
        }else{
            $query = FoliosCoordinador::find()->where('c05_id=:usuario',[':usuario'=>Yii::$app->user->getId()]);
        }

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
            'r17_id' => $this->r17_id,
            'c05_id' => $this->c05_id,
            'r17_rangoInicio' => $this->r17_rangoInicio,
            'r17_rangoFin' => $this->r17_rangoFin,
            'r17_usuAlta' => $this->r17_usuAlta,
            'r17_fecAlta' => $this->r17_fecAlta,
            'r17_usuMod' => $this->r17_usuMod,
            'r17_fecMod' => $this->r17_fecMod,
            'r17_tipo_dictamen' => $this->r17_tipo_dictamen,
        ]);

        return $dataProvider;
    }
}
