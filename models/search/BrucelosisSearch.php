<?php

namespace app\models\search;

use app\models\Grupos;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Brucelosis;

/**
 * BrucelosisSearch represents the model behind the search form about `app\models\Brucelosis`.
 */
class BrucelosisSearch extends Brucelosis
{
    /**
     * @inheritdoc
     */
    public $fecha_desde;
    public $fecha_hasta;
    public function rules()
    {
        return [
            [['p03_id', 'p03_folio', 'p03_nocaso', 'c05_id', 'c01_id', 'r01_id', 'p03_dictamenAnt', 'p03_tipoPrueba', 'p03_motivoPrueba', 'p03_funcZoo', 'p03_tipomvz', 'p03_totalHato', 'p03_muestraHato', 'p03_consHatoNo', 'p03_activo', 'p03_usuAlta', 'p03_usuMod', 'p03_tipoMuestras', 'p03_isdictaminado'], 'integer'],
            [['p03_fpruebaAnt', 'p03_fproxPrueba', 'p03_espTipo', 'p03_espMotivo', 'p03_fmuestreo', 'p03_frecepcion', 'p03_frealizacion', 'p03_tipoAux', 'p03_fecha', 'p03_constHatoFecha', 'p03_vigencia', 'p03_fecAlta', 'p03_fecMod', 'fecha_desde', 'fecha_hasta'], 'safe'],
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
            $query = Brucelosis::find()->where('p03_activo=:activo',[':activo'=>1])->orderBy('p03_fecAlta DESC');
        }else if(User::isUserAdmin(Yii::$app->user->getId())){
            $query = Brucelosis::find()->where('p03_activo=:activo',[':activo'=>1])->orderBy('p03_fecAlta DESC');
        }else if(User::isUserLab(Yii::$app->user->getId())){
            $query = Brucelosis::find()->
            Where('p03_activo=:activo', [':activo'=>1])->
            andwhere('p03_laboratorio=:lab', [':lab'=>Yii::$app->user->getId()])->
            //andWhere('p03_fj is null')->
            andWhere('p03_tipoPrueba!=3')->
            orderBy('p03_fecAlta DESC');
        }else{
            $grupos = Grupos::getUsuarios();
            $query = Brucelosis::find()->where('p03_usuAlta=:usuario || c05_id=(SELECT c05_id FROM c05_mvz WHERE user_id=:usuario)',[':usuario'=>Yii::$app->user->getId()]);
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
            'p03_nocaso' => $this->p03_nocaso,
            'c05_id' => $this->c05_id,
            'c01_id' => $this->c01_id,
            'r01_id' => $this->r01_id,
            'p03_fpruebaAnt' => $this->p03_fpruebaAnt,
            'p03_dictamenAnt' => $this->p03_dictamenAnt,
            'p03_fproxPrueba' => $this->p03_fproxPrueba,
            'p03_tipoPrueba' => $this->p03_tipoPrueba,
            'p03_motivoPrueba' => $this->p03_motivoPrueba,
            'p03_funcZoo' => $this->p03_funcZoo,
            'p03_fmuestreo' => $this->p03_fmuestreo,
            'p03_frecepcion' => $this->p03_frecepcion,
            'p03_frealizacion' => $this->p03_frealizacion,
            'p03_tipomvz' => $this->p03_tipomvz,
            'p03_fecha' => $this->p03_fecha,
            'p03_totalHato' => $this->p03_totalHato,
            'p03_muestraHato' => $this->p03_muestraHato,
            'p03_consHatoNo' => $this->p03_consHatoNo,
            'p03_constHatoFecha' => $this->p03_constHatoFecha,
            'p03_vigencia' => $this->p03_vigencia,
            'p03_activo' => $this->p03_activo,
            'p03_tipoMuestras' => $this->p03_tipoMuestras,
            'p03_usuAlta' => $this->p03_usuAlta,
            'p03_fecAlta' => $this->p03_fecAlta,
            'p03_usuMod' => $this->p03_usuMod,
            'p03_fecMod' => $this->p03_fecMod,
            'p03_isdictaminado' => $this->p03_isdictaminado,
        ]);

        $query->andFilterWhere(['like', 'p03_espTipo', $this->p03_espTipo])
            ->andFilterWhere(['like', 'p03_espMotivo', $this->p03_espMotivo])
            ->andFilterWhere(['like', 'p03_tipoAux', $this->p03_tipoAux]);

        $query->andFilterWhere(['>=', 'p03_fecAlta', $this->fecha_desde]);
        $query->andFilterWhere(['<=', 'p03_fecAlta', $this->fecha_hasta]);

        return $dataProvider;
    }

}
