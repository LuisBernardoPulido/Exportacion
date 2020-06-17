<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r05_seleccion_previa_aretes".
 *
 * @property integer $r05_id
 * @property integer $p02_id
 * @property integer $r02_id
 * @property string $r02_edad
 * @property string $r02_raza
 * @property string $r02_raza2
 * @property string $r02_sexo
 * @property integer $r05_tb
 * @property integer $r05_br
 * @property integer $r05_vc
 * @property integer $r05_filtro
 * @property integer $r05_usuAlta
 * @property string $r05_fecAlta
 *
 * @property P02SeleccionPrevia $p02
 * @property R02Aretes $r02
 */
class SeleccionPreviaAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r05_seleccion_previa_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r02_id'], 'required'],
            [['p02_id', 'r02_id', 'r05_tb', 'r05_br', 'r05_vc','r05_gr', 'r05_filtro', 'r05_usuAlta'], 'integer'],
            [['r05_fecAlta'], 'safe'],
            [['r02_edad', 'r02_raza', 'r02_raza2', 'r02_sexo'], 'string', 'max' => 50],
            [['p02_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeleccionPrevia::className(), 'targetAttribute' => ['p02_id' => 'p02_id']],
            [['r02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aretes::className(), 'targetAttribute' => ['r02_id' => 'r02_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r05_id' => 'ID Arete Seleccionado',
            'p02_id' => 'Selección previa',
            'r02_id' => 'Arete ID',
            'r02_edad' => 'Edad',
            'r02_raza' => 'Raza',
            'r02_raza2' => 'Raza de Cruza',
            'r02_sexo' => 'Sexo',
            'r05_tb' => 'Tuberculosis',
            'r05_br' => 'Brucelosis',
            'r05_vc' => 'Vacunación',
            'r05_gr' => 'Garrapata',
            'r05_filtro' => 'Filtro',
            'r05_usuAlta' => 'Usuario Alta',
            'r05_fecAlta' => 'R05 Fec Alta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP02()
    {
        return $this->hasOne(SeleccionPrevia::className(), ['p02_id' => 'p02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR02()
    {
        return $this->hasOne(Aretes::className(), ['r02_id' => 'r02_id']);
    }


    public static function getAretesSinAsginar(){
        $aretes = SeleccionPreviaAretes::find()
            ->where('p02_id is NULL')->andWhere('r05_usuAlta=:user', [':user'=>Yii::$app->user->getId()])->andWhere('r05_filtro=:uno', [':uno'=>1])->joinWith('r02 a')->orderBy('a.r02_numero');

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }

    public static function addAretesPorUppSinMostrar($upp, $prueba){

        $todos = Aretes::find()->where('r01_id=:id', ['id'=>$upp])->andWhere('r02_mostrar!=-1')->all();

        foreach($todos as $t) {
            $busqueda = SeleccionPreviaAretes::find()->where('r02_id=:id', [':id'=>$t->r02_id])->andWhere('p02_id=:prueba', [':prueba'=>$prueba])->one();
            if(!$busqueda){
                $dic = new SeleccionPreviaAretes();
                $dic->p02_id = $prueba;
                $dic->r02_id = $t->r02_id;
                $dic->r05_usuAlta = Yii::$app->user->getId();
                $dic->r05_fecAlta = Utileria::horaFechaActual();
                $dic->save();
            }

        }
    }

    public static function getAretesPorSeleccion($id){

        //Esta parte selecciona todos los aretes de la upp, nada recomendable
        /*$prueba = SeleccionPrevia::findOne($id);
        if($prueba){
            self::addAretesPorUppSinMostrar($prueba->c01_id, $id);
        }*/

        $aretes = SeleccionPreviaAretes::find()
            ->where('p02_id=:id', [':id'=>$id])->andWhere('r05_filtro=:uno', [':uno'=>1])->joinWith('r02 a')->orderBy('a.r02_numero');


        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getAretesPorSeleccionAll($id){
        $aretes = SeleccionPreviaAretes::find()
            ->where('p02_id=:id', [':id'=>$id])->joinWith('r02 a')->orderBy('a.r02_numero');

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
