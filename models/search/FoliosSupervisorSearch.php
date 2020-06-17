<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoliosSupervisor;
use app\models\User;

/**
 * FoliosSupervisorSearch represents the model behind the search form about `app\models\FoliosSupervisor`.
 */
class FoliosSupervisorSearch extends FoliosSupervisor
{
    public $r15_rangoInicio;
    public $r15_rangoFin;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r15_id', 'c05_id', 'r15_usuAlta', 'r15_usuMod', 'r15_tipo_dictamen'], 'integer'],
            [['r15_rangoInicio', 'r15_rangoFin', 'r15_fecAlta', 'r15_fecMod'], 'safe'],
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
       // $query = FoliosSupervisor::find();
        if(User::isUserAdmin(Yii::$app->user->getId())){
            $query = FoliosSupervisor::find();
        }else if(User::isUserCoordinador(Yii::$app->user->getId())){
            $query = FoliosSupervisor::find()->where('r15_usuAlta=:usuario',[':usuario'=>Yii::$app->user->getId()]);
        }else{
            $query = FoliosSupervisor::find()->where('c05_id=:usuario',[':usuario'=>Yii::$app->user->getId()]);
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
            'r15_id' => $this->r15_id,
            'c05_id' => $this->c05_id,
            'r15_usuAlta' => $this->r15_usuAlta,
            'r15_fecAlta' => $this->r15_fecAlta,
            'r15_usuMod' => $this->r15_usuMod,
            'r15_fecMod' => $this->r15_fecMod,
            'r15_tipo_dictamen' => $this->r15_tipo_dictamen,
        ]);

        $query->andFilterWhere(['<=', 'r15_rangoInicio', $this->r15_rangoInicio]);
        $query->andFilterWhere(['>=', 'r15_rangoFin', $this->r15_rangoFin]);

        return $dataProvider;
    }
}
