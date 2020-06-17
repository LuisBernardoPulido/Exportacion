<?php

namespace app\models\search;

use app\models\Grupos;
use app\models\GruposUsuarios;
use app\models\PerfilUsuario;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SeleccionPrevia;

/**
 * SeleccionPreviaSearch represents the model behind the search form about `app\models\SeleccionPrevia`.
 */
class SeleccionPreviaSearch extends SeleccionPrevia
{
    public $fecha_desde;
    public $fecha_hasta;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p02_id', 'c05_id', 'c01_id', 'p02_activo', 'p02_usuAlta', 'p02_usuMod', 'c01_ganadero'], 'integer'],
            [['p02_fecAlta', 'p02_fecMod', 'fecha_desde', 'fecha_hasta'], 'safe'],
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
            $query = SeleccionPrevia::find()->where('p02_activo=:activo', [':activo'=>1])->orderBy('p02_fecAlta DESC');
        }else if(User::isUserAdmin(Yii::$app->user->getId())){
            $query = SeleccionPrevia::find()->where('p02_activo=:activo', [':activo'=>1])->orderBy('p02_fecAlta DESC');
        }else{
            $grupos = Grupos::getUsuarios();

            $query = SeleccionPrevia::find()->where('p02_usuAlta=:usuario',[':usuario'=>Yii::$app->user->getId()]);

            foreach ($grupos->all() as $gr){
                $query->orFilterWhere(['=', 'p02_usuAlta', $gr->a01_id]);
            }

            $query->andFilterWhere(['=', 'p02_activo', 1]);

            $query->orderBy('p02_fecAlta DESC');
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
            'p02_id' => $this->p02_id,
            'c05_id' => $this->c05_id,
            'c01_id' => $this->c01_id,
            'c01_ganadero' => $this->c01_ganadero,
            'r03_dictamen_tb' => $this->r03_dictamen_tb,
            'r03_dictamen_vc' => $this->r03_dictamen_vc,
            'r03_dictamen_br' => $this->r03_dictamen_br,
            'p02_activo' => $this->p02_activo,
            'p02_usuAlta' => $this->p02_usuAlta,
            'p02_fecAlta' => $this->p02_fecAlta,
            'p02_usuMod' => $this->p02_usuMod,
            'p02_fecMod' => $this->p02_fecMod,
        ]);

        $query->andFilterWhere(['>=', 'p02_fecAlta', $this->fecha_desde]);
        $query->andFilterWhere(['<=', 'p02_fecAlta', $this->fecha_hasta]);

        return $dataProvider;
    }
}
