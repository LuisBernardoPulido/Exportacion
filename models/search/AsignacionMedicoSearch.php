<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AsignacionMedico;

/**
 * AsignacionMedicoSearch represents the model behind the search form about `app\models\AsignacionMedico`.
 */
class AsignacionMedicoSearch extends AsignacionMedico
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r03_id', 'c05_id', 'c01_id', 'r01_id', 'r03_tipoprueba', 'r03_nodictamen', 'r03_motivoprueba', 'r03_tipomvz'], 'integer'],
            [['r03_fpruebaant', 'r03_finyeccion', 'r03_flectura', 'r03_tipo', 'r03_fecha'], 'safe'],
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
    public function search($params, $tipo='N')
    {
        if($tipo!='N'){
            $query = AsignacionMedico::find()->where('r03_tipo=:tipo', [':tipo'=>$tipo]);
        }else {
            $query = AsignacionMedico::find();
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
            'r03_id' => $this->r03_id,
            'c05_id' => $this->c05_id,
            'c01_id' => $this->c01_id,
            'r01_id' => $this->r01_id,
            'r03_fpruebaant' => $this->r03_fpruebaant,
            'r03_tipoprueba' => $this->r03_tipoprueba,
            'r03_nodictamen' => $this->r03_nodictamen,
            'r03_motivoprueba' => $this->r03_motivoprueba,
            'r03_finyeccion' => $this->r03_finyeccion,
            'r03_flectura' => $this->r03_flectura,
            'r03_tipomvz' => $this->r03_tipomvz,
            'r03_fecha' => $this->r03_fecha,
        ]);

        $query->andFilterWhere(['like', 'r03_tipo', $this->r03_tipo]);

        return $dataProvider;
    }
}
