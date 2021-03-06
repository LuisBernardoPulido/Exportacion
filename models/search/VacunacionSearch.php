<?php

namespace app\models\search;

use app\models\Grupos;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacunacion;

/**
 * VacunacionSearch represents the model behind the search form about `app\models\Vacunacion`.
 */
class VacunacionSearch extends Vacunacion
{
    /**
     * @inheritdoc
     */
    public $fecha_desde;
    public $fecha_hasta;
    public function rules()
    {
        return [
            [['p03_id', 'p03_folio', 'c05_id', 'c01_id', 'r01_id', 'p03_totalHato', 'p03_totalbovinos', 'p03_totalcaprinos', 'p03_totalovinos', 'p03_totalotros', 'p03_tipohato', 'p03_cepa', 'p03_rb', 'p03_rev', 'p03_isdictaminado', 'p03_activo', 'p03_usuAlta', 'p03_usuMod'], 'integer'],
            [['p03_fexpedicion', 'p03_esptotalotros', 'p03_laboratorio', 'p03_lote_clasica', 'p03_lote_reducida', 'p03_lote_becerra', 'p03_lote_vaca', 'p03_cad_clasica', 'p03_cad_reducida', 'p03_cad_becerra', 'p03_cad_vaca', 'p03_vigencia', 'p03_fecAlta', 'p03_fecMod', 'fecha_desde', 'fecha_hasta'], 'safe'],
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

        if(User::isUserSupervisor(Yii::$app->user->getId()) || User::isUserCoordinador(Yii::$app->user->getId()) ){
            $query = Vacunacion::find()->where('p03_activo=:activo', [':activo'=>1])->orderBy('p03_fecAlta DESC');
        }else if(User::isUserAdmin(Yii::$app->user->getId())){
            $query = Vacunacion::find()->where('p03_activo=:activo', [':activo'=>1])->orderBy('p03_fecAlta DESC');
        }else{
            $grupos = Grupos::getUsuarios();
            $query = Vacunacion::find()->where('p03_usuAlta=:usuario || c05_id=(SELECT c05_id FROM c05_mvz WHERE user_id=:usuario)',[':usuario'=>Yii::$app->user->getId()]);
            if(!User::isUserMedico(Yii::$app->user->getId())){
                $query->orFilterWhere(['=', 'p03_usuAlta', 0]);
                $query->orWhere('p03_usuAlta is null');
            }


            foreach ($grupos->all() as $gr){
                $query->orFilterWhere(['=', 'p03_usuAlta', $gr->a01_id]);
            }

            $query->andFilterWhere(['=', 'p03_activo', 1]);
            $query->orderBy('p03_fecAlta DESC');
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
            'p03_id' => $this->p03_id,
            'p03_folio' => $this->p03_folio,
            'c05_id' => $this->c05_id,
            'c01_id' => $this->c01_id,
            'r01_id' => $this->r01_id,
            'p03_fexpedicion' => $this->p03_fexpedicion,
            'p03_totalHato' => $this->p03_totalHato,
            'p03_totalbovinos' => $this->p03_totalbovinos,
            'p03_totalcaprinos' => $this->p03_totalcaprinos,
            'p03_totalovinos' => $this->p03_totalovinos,
            'p03_totalotros' => $this->p03_totalotros,
            'p03_tipohato' => $this->p03_tipohato,
            'p03_cepa' => $this->p03_cepa,
            'p03_rb' => $this->p03_rb,
            'p03_rev' => $this->p03_rev,
            'p03_cad_clasica' => $this->p03_cad_clasica,
            'p03_cad_reducida' => $this->p03_cad_reducida,
            'p03_cad_becerra' => $this->p03_cad_becerra,
            'p03_cad_vaca' => $this->p03_cad_vaca,
            'p03_vigencia' => $this->p03_vigencia,
            'p03_isdictaminado' => $this->p03_isdictaminado,
            'p03_activo' => $this->p03_activo,
            'p03_usuAlta' => $this->p03_usuAlta,
            'p03_fecAlta' => $this->p03_fecAlta,
            'p03_usuMod' => $this->p03_usuMod,
            'p03_fecMod' => $this->p03_fecMod,
        ]);

        $query->andFilterWhere(['like', 'p03_esptotalotros', $this->p03_esptotalotros])
            ->andFilterWhere(['like', 'p03_laboratorio', $this->p03_laboratorio])
            ->andFilterWhere(['like', 'p03_lote_clasica', $this->p03_lote_clasica])
            ->andFilterWhere(['like', 'p03_lote_reducida', $this->p03_lote_reducida])
            ->andFilterWhere(['like', 'p03_lote_becerra', $this->p03_lote_becerra])
            ->andFilterWhere(['like', 'p03_lote_vaca', $this->p03_lote_vaca]);

        $query->andFilterWhere(['>=', 'p03_fecAlta', $this->fecha_desde]);
        $query->andFilterWhere(['<=', 'p03_fecAlta', $this->fecha_hasta]);

        return $dataProvider;
    }
}
