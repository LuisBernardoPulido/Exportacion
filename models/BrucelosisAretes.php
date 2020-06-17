<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "r07_brucelosis_aretes".
 *
 * @property integer $r07_id
 * @property integer $p03_br
 * @property integer $r02_id
 * @property integer $r07_resultado
 * @property string $r07_uno
 * @property string $r07_rivanol
 * @property integer $r07_rivanol_estatus
 * @property string $r07_frealizacion
 * @property integer $r07_ordenar
 * @property integer $r07_ordenar_dictamen
 * @property integer $r07_usuAlta
 * @property string $r07_fecAlta
 * @property integer $r07_usuMod
 * @property string $r07_fecMod
 *
 * @property P03Br $p03Br
 * @property R02Aretes $r02
 * @property C13Tiporesultados $r07Resultado
 */
class BrucelosisAretes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const NEGATIVO =1;
    const POSITIVO =2;
    const HEMOLIZADO = 3;

    //RIVANOL
    const NEGATIVO_RV = 8;
    const OP_1 = 9;
    const OP_2 = 10;
    const OP_3 = 11;
    const OP_4 = 26;
    const OP_5 = 27;
    const OP_6 = 28;

    public static function tableName()
    {
        return 'r07_brucelosis_aretes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p03_br', 'r02_id', 'r07_resultado', 'r07_rivanol_estatus', 'r07_usuAlta', 'r07_ordenar', 'r07_ordenar_dictamen', 'r07_usuMod'], 'integer'],
            [['r07_frealizacion', 'r07_fecAlta', 'r07_fecMod'], 'safe'],
            [['r07_uno'], 'string', 'max' => 10],
            [['r07_rivanol'], 'string', 'max' => 50],
            [['p03_br'], 'exist', 'skipOnError' => true, 'targetClass' => Brucelosis::className(), 'targetAttribute' => ['p03_br' => 'p03_id']],
            [['r02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aretes::className(), 'targetAttribute' => ['r02_id' => 'r02_id']],
            [['r07_resultado'], 'exist', 'skipOnError' => true, 'targetClass' => Resultados::className(), 'targetAttribute' => ['r07_resultado' => 'c13_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r07_id' => 'ID Registro',
            'p03_br' => 'Dictamen BR',
            'r02_id' => 'ID Arete',
            'r07_resultado' => 'Resultado',
            'r07_uno' => 'UNO',
            'r07_rivanol' => 'Resultado Rivanol',
            'r07_rivanol_estatus' => '0:Negativo, 1:Positivo',
            'r07_frealizacion' => 'Fecha de realización',
            'r07_ordenar' => 'Ordenar Hoja de Resultados',
            'r07_ordenar_dictamen' => 'Ordenar Dictamen BR',
            'r07_usuAlta' => 'Usuario Alta',
            'r07_fecAlta' => 'Fecha de Alta',
            'r07_usuMod' => 'Usuario Modificación',
            'r07_fecMod' => 'Fecha Módificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP03Br()
    {
        return $this->hasOne(Brucelosis::className(), ['p03_id' => 'p03_br']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR02()
    {
        return $this->hasOne(Aretes::className(), ['r02_id' => 'r02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR07Resultado()
    {
        return $this->hasOne(Resultados::className(), ['c13_id' => 'r07_resultado']);
    }

    //Generamos aretes dada una prueba y un dictamen
    public static function generarAretes($prueba, $id){
        $aretesinvalidos = BrucelosisAretes::find()->where('p03_br=:br', [':br'=>$id])->andWhere('r07_resultado is null')->all();
        foreach($aretesinvalidos as $a){
            $a->delete();
        }

        $aretesSeleccion = SeleccionPreviaAretes::find()->where('p02_id=:id', [':id'=>$prueba->p02_id])->andWhere('r05_br=:num',[':num'=>1])->joinWith('r02 a')->orderBy('a.r02_numero')->all();
        /*$aretesSeleccion = SeleccionPreviaAretes::findBySql("
SELECT * FROM
r05_seleccion_previa_aretes r05
INNER JOIN r02_aretes r02 ON r02.r02_id=r05.r02_id 
WHERE p02_id=$prueba AND r05_br=1
AND r05.r02_id not in (select r02_id from r07_brucelosis_aretes where p03_br=$id)
ORDER BY r02_numero
")->all();*/
        foreach ($aretesSeleccion as $arete){
            $nuevo = new BrucelosisAretes();
            $nuevo->p03_br = $id;
            $nuevo->r02_id = $arete->r02_id;
            $nuevo->r07_usuAlta = Yii::$app->user->getId();
            $nuevo->save();
        }


    }

    //Regresa los aretes asignados por cada dictamen
    public static function getAretesPorDictamenSinResultado(){

        $aretes = BrucelosisAretes::find()
            ->where('r07_resultado is NULL')
            //->andwhere('p03_br=:br', [':br'=>$br])
            ->andWhere('r07_usuAlta=:user', [':user'=>Yii::$app->user->getId()]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getAretesPorDictamenSinResultadoT($br){

        if(User::isUserLab(Yii::$app->user->getId())){

            $prueba = Yii::$app->db->createCommand("
select p02_id as p02_id from p02_seleccion_previa where r03_dictamen_br=
(select p03_id from p03_br where p03_id=
(select p03_br from r07_brucelosis_aretes where p03_br=$br limit 1))
",[])->queryAll();

            /*$edad = Yii::$app->db->createCommand("
select if((select r02_especie from r02_aretes where r02_id=(select r02_id from r05_seleccion_previa_aretes where p02_id=".$prueba[0]['p02_id']." limit 1))=1,3,2) AS edad
",[])->queryAll();*/

            $aretes = BrucelosisAretes::find()
                ->alias('r07')
                ->join('inner join','r05_seleccion_previa_aretes r05', 'r05.r02_id=r07.r02_id and r05.p02_id='.$prueba[0]['p02_id'].'')
                ->where('r07_resultado is NULL')
                ->andwhere('p03_br=:br', [':br'=>$br])
                ->andWhere('r07_usuAlta=:user', [':user'=>Yii::$app->user->getId()]);
                //->andWhere('r05.r02_edad>:edad',[':edad'=>intval($edad[0]['edad'])]);


            $dataprovider = new ActiveDataProvider([
                'query' => $aretes,
                'pagination' => ['pageSize' => 5000],
            ]);
        }else{
            $aretes = BrucelosisAretes::find()
                ->where('r07_resultado is NULL')
                ->andwhere('p03_br=:br', [':br'=>$br])
                ->andWhere('r07_usuAlta=:user', [':user'=>Yii::$app->user->getId()]);

            $dataprovider = new ActiveDataProvider([
                'query' => $aretes,
                'pagination' => ['pageSize' => 5000],
            ]);
        }

        return $dataprovider;
    }
    //Regresa los aretes asignados por cada dictamen
    public static function getAretesPorDictamenSinResultadoFJ($br){

        $aretes = BrucelosisAretes::find()
            ->where('r07_resultado is NULL')
            ->andwhere('p03_br=:br', [':br'=>$br]);

        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
    public static function getAretesPorDictamenConResultado($br){
        $aretesinvalidos = BrucelosisAretes::find()->where('p03_br=:br', [':br'=>$br])->andWhere('r07_resultado is null')->all();
        foreach($aretesinvalidos as $a){
            $a->delete();
        }

        if(User::isUserLab(Yii::$app->user->getId())){

            /*$prueba = Yii::$app->db->createCommand("
select p02_id as p02_id from p02_seleccion_previa where r03_dictamen_br=
(select p03_id from p03_br where p03_id=
(select p03_br from r07_brucelosis_aretes where p03_br=$br limit 1))
",[])->queryAll();
            $edad = Yii::$app->db->createCommand("
select if((select r02_especie from r02_aretes where r02_id=(select r02_id from r05_seleccion_previa_aretes where p02_id=".$prueba[0]['p02_id']." limit 1))=1,3,2) AS edad
",[])->queryAll();

            $aretes = BrucelosisAretes::find()
                ->alias('r07')
                ->join('inner join','r05_seleccion_previa_aretes r05', 'r05.r02_id=r07.r02_id and r05.p02_id='.$prueba[0]['p02_id'].'')
                ->andwhere('p03_br=:br', [':br'=>$br])
                ->andWhere('r05.r02_edad>:edad',[':edad'=>intval($edad[0]['edad'])]);*/
            $aretes = BrucelosisAretes::find()
                ->where('p03_br=:br', [':br'=>$br]);


            $dataprovider = new ActiveDataProvider([
                'query' => $aretes,
                'pagination' => ['pageSize' => 5000],
            ]);
        }else{
            $aretes = BrucelosisAretes::find()
                ->where('p03_br=:br', [':br'=>$br]);

            $dataprovider = new ActiveDataProvider([
                'query' => $aretes,
                'pagination' => ['pageSize' => 5000],
            ]);
        }



        $dataprovider = new ActiveDataProvider([
            'query' => $aretes,
            'pagination' => ['pageSize' => 5000],
        ]);
        return $dataprovider;
    }
}
