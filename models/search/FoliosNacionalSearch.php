<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoliosNacional;
use app\models\User;

/**
 * FoliosNacionalSearch represents the model behind the search form about `app\models\FoliosNacional`.
 */
class FoliosNacionalSearch extends FoliosNacional
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r19_id', 'user_role', 'r19_rangoInicio', 'r19_rangoFin', 'r19_usuAlta', 'r19_usuMod', 'r19_tipo_dictamen'], 'integer'],
            [['r19_fecAlta', 'r19_fecMod'], 'safe'],
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
        if(User::isUserSuperAdmin(Yii::$app->user->getId()) ){
            $query = FoliosNacional::find();
        }else if(User::isUserNacional(Yii::$app->user->getId()) ){
            $query = FoliosNacional::find()->where('r19_usuAlta=:usuario || user_role=:usuario',[':usuario'=>Yii::$app->user->getId()]);
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
            'r19_id' => $this->r19_id,
            'user_role' => $this->user_role,
            'r19_rangoInicio' => $this->r19_rangoInicio,
            'r19_rangoFin' => $this->r19_rangoFin,
            'r19_usuAlta' => $this->r19_usuAlta,
            'r19_fecAlta' => $this->r19_fecAlta,
            'r19_usuMod' => $this->r19_usuMod,
            'r19_fecMod' => $this->r19_fecMod,
            'r19_tipo_dictamen' => $this->r19_tipo_dictamen,
        ]);

        return $dataProvider;
    }
}
