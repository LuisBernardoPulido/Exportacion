<?php

namespace app\models\search;

use app\models\Grupos;
use app\models\User;
use app\models\Users;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resenas;

/**
 * ResenasSearch represents the model behind the search form about `app\models\Resenas`.
 */
class ResenasSearch extends Resenas
{
    public $fecha_desde;
    public $fecha_hasta;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p01_id', 'p01_medico', 'p01_upp', 'p01_ganadero','p01_especie'], 'integer'],
            [['p01_fecharealizacion', 'p01_usuarioCreate', 'p01_fechaCreate', 'fecha_desde', 'fecha_hasta'], 'safe'],
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
        if(User::isUserSupervisor(Yii::$app->user->getId()) || User::isUserCoordinador(Yii::$app->user->getId())){
            $query = Resenas::find()->where('p01_activo=:activo', [':activo'=>1])->orderBy('p01_fecharealizacion DESC');
        }else if(User::isUserAdmin(Yii::$app->user->getId())){
            $query = Resenas::find()->where('p01_activo=:activo', [':activo'=>1])->orderBy('p01_fecharealizacion DESC');
        }else{
            $grupos = Grupos::getUsuarios();


            $query = Resenas::find()->where('p01_usuarioCreate=:usuario',[':usuario'=>Yii::$app->user->getId()]);

            if(!User::isUserMedico(Yii::$app->user->getId())) {
                $query->orFilterWhere(['=', 'p01_usuarioCreate', 0]);
            }

            foreach ($grupos->all() as $gr){
                $query->orFilterWhere(['=', 'p01_usuarioCreate', $gr->a01_id]);
            }

            $query->andFilterWhere(['=', 'p01_activo', 1]);
            $query->orderBy('p01_fecharealizacion DESC');
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
            'p01_id' => $this->p01_id,
            'p01_medico' => $this->p01_medico,
            'p01_upp' => $this->p01_upp,
            'p01_ganadero' => $this->p01_ganadero,
            'p01_fecharealizacion' => $this->p01_fecharealizacion,
            'p01_usuarioCreate' => $this->p01_usuarioCreate,
            'p01_fechaCreate' => $this->p01_fechaCreate,
            'p01_especie' => $this->p01_especie,
        ]);

        $query->andFilterWhere(['>=', 'p01_fecharealizacion', $this->fecha_desde]);
        $query->andFilterWhere(['<=', 'p01_fecharealizacion', $this->fecha_hasta]);
        return $dataProvider;
    }
}
