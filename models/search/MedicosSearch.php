<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Medicos;

/**
 * MedicosSearch represents the model behind the search form about `app\models\Medicos`.
 */
class MedicosSearch extends Medicos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_id', 'c05_activo'], 'integer'],
            [['c05_clave', 'c05_nombre', 'c05_apaterno', 'c05_amaterno', 'c05_curp', 'c05_rfc', 'c05_telefono', 'c05_colonia', 'c05_calle', 'c05_cp', 'c05_localidad', 'c05_municipio', 'c05_estado', 'c05_correo', 'c05_tipomvz', 'c05_identificacion', 'c05_fexpiracionlicencia', 'c05_usuario', 'c05_contrasena'], 'safe'],
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
        $query = Medicos::find()->where('c05_activo!=:activo', [':activo'=>-1]);

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
            'c05_id' => $this->c05_id,
            'c05_fexpiracionlicencia' => $this->c05_fexpiracionlicencia,
            'c05_activo' => $this->c05_activo,
        ]);

        $query->andFilterWhere(['like', 'c05_clave', $this->c05_clave])
            ->andFilterWhere(['like', 'c05_nombre', $this->c05_nombre])
            ->andFilterWhere(['like', 'c05_apaterno', $this->c05_apaterno])
            ->andFilterWhere(['like', 'c05_amaterno', $this->c05_amaterno])
            ->andFilterWhere(['like', 'c05_curp', $this->c05_curp])
            ->andFilterWhere(['like', 'c05_rfc', $this->c05_rfc])
            ->andFilterWhere(['like', 'c05_telefono', $this->c05_telefono])
            ->andFilterWhere(['like', 'c05_colonia', $this->c05_colonia])
            ->andFilterWhere(['like', 'c05_calle', $this->c05_calle])
            ->andFilterWhere(['like', 'c05_cp', $this->c05_cp])
            ->andFilterWhere(['like', 'c05_localidad', $this->c05_localidad])
            ->andFilterWhere(['like', 'c05_municipio', $this->c05_municipio])
            ->andFilterWhere(['like', 'c05_estado', $this->c05_estado])
            ->andFilterWhere(['like', 'c05_correo', $this->c05_correo])
            ->andFilterWhere(['like', 'c05_tipomvz', $this->c05_tipomvz])
            ->andFilterWhere(['like', 'c05_identificacion', $this->c05_identificacion])
            ->andFilterWhere(['like', 'c05_usuario', $this->c05_usuario])
            ->andFilterWhere(['like', 'c05_contrasena', $this->c05_contrasena]);

        return $dataProvider;
    }
}
