<?php

namespace app\models\search;

use app\models\Grupos;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tuberculosis;

/**
 * TuberculosisSearch represents the model behind the search form about `app\models\Tuberculosis`.
 */
class TuberculosisRepSearch extends Tuberculosis
{
    public $fecha_desde;
    public $fecha_hasta;
    public $repetidos_tb;
    /**
     * @inheritdoc
     */
    public $p02_id;

    public function rules()
    {
        return [
            [['p03_id', 'p03_folio', 'c05_id', 'c01_id', 'r01_id', 'p03_dictamenAnt', 'p03_tipoPrueba', 'p03_motivoPrueba', 'p03_funcZoo', 'p03_tipomvz', 'p03_totalHato', 'p03_muestraHato', 'p03_consHatoNo', 'p03_activo', 'p03_usuAlta', 'p03_usuMod', 'p03_isdictaminado'], 'integer'],
            [['p03_fpruebaAnt', 'p03_fproxPrueba', 'p03_espTipo', 'p03_espMotivo', 'p03_finyeccion', 'p03_flectura', 'p03_tipoAux', 'p03_fecha', 'p03_constHatoFecha', 'p03_vigencia', 'p03_fecAlta', 'p03_fecMod', 'p02_id', 'fecha_desde', 'fecha_hasta','repetidos_tb'], 'safe'],
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
        /*$query = Tuberculosis::find()->select('*, COUNT(*) AS repetidos_tb')
            ->groupBy(['p03_finyeccion', 'r01_id', 'p03_tipoPrueba'])
            ->having('repetidos_tb>1')
            ->orderby(['repetidos_tb'=>SORT_DESC])
            ->all();;*/

        $query = Tuberculosis::find()->select('*, COUNT(*) AS repetidos_tb')
            ->groupBy(['p03_finyeccion', 'r01_id', 'p03_tipoPrueba'])
            ->having('repetidos_tb>1')
            ->orderby(['repetidos_tb'=>SORT_DESC]);

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
            'p03_fpruebaAnt' => $this->p03_fpruebaAnt,
            'p03_dictamenAnt' => $this->p03_dictamenAnt,
            'p03_fproxPrueba' => $this->p03_fproxPrueba,
            'p03_tipoPrueba' => $this->p03_tipoPrueba,
            'p03_motivoPrueba' => $this->p03_motivoPrueba,
            'p03_funcZoo' => $this->p03_funcZoo,
            'p03_finyeccion' => $this->p03_finyeccion,
            'p03_flectura' => $this->p03_flectura,
            'p03_tipomvz' => $this->p03_tipomvz,
            'p03_fecha' => $this->p03_fecha,
            'p03_totalHato' => $this->p03_totalHato,
            'p03_muestraHato' => $this->p03_muestraHato,
            'p03_consHatoNo' => $this->p03_consHatoNo,
            'p03_constHatoFecha' => $this->p03_constHatoFecha,
            'p03_vigencia' => $this->p03_vigencia,
            'p03_activo' => $this->p03_activo,
            'p03_usuAlta' => $this->p03_usuAlta,
            'p03_fecAlta' => $this->p03_fecAlta,
            'p03_usuMod' => $this->p03_usuMod,
            'p03_fecMod' => $this->p03_fecMod,
            'p03_isdictaminado' => $this->p03_isdictaminado,
            //'p02_seleccion_previa.p02_id' => $this->p02_id,
        ]);

        $query->andFilterWhere(['like', 'p03_espTipo', $this->p03_espTipo])
            ->andFilterWhere(['like', 'p03_espMotivo', $this->p03_espMotivo])
            ->andFilterWhere(['like', 'p03_tipoAux', $this->p03_tipoAux]);

        //$query->andFilterWhere(['like', 'p02_seleccion_previa.p02_id', $this->prueba]);
        $query->andFilterWhere(['>=', 'p03_fecAlta', $this->fecha_desde]);
        $query->andFilterWhere(['<=', 'p03_fecAlta', $this->fecha_hasta]);
        $query->andFilterWhere(['like', 'p03_activo', $this->repetidos_tb]);

        return $dataProvider;
    }
}
