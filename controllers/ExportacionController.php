<?php

namespace app\controllers;

use app\models\Aretes;
use app\models\Estados;
use app\models\EstatusSanitario;
use app\models\EstatusSanitarioEstatal;
use app\models\EstatusSenasica;
use app\models\EstatusUsda;
use app\models\ExcepcionesEstatusSanitario;
use app\models\ExportacionAretes;
use app\models\Ganaderos;
use app\models\InternacionAretes;
use app\models\LocalidadesZac;
use app\models\Municipios;
use app\models\PropietarioUnidad;
use app\models\Upp;
use app\models\Zonas;
use Yii;
use app\models\Exportacion;
use app\models\search\ExportacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExportacionController implements the CRUD actions for Exportacion model.
 */
class ExportacionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Exportacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExportacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Exportacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Exportacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Exportacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->p11_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Exportacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->p11_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Exportacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Exportacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exportacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exportacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionUnidadesdestino($q = null, $id = null, $prod) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = Yii::$app->db->createCommand("
SELECT 
r01.r01_id as id,
CONCAT(r01.r01_clave, ' - ' ,r01_nombre) as text
FROM r01_upp r01
/*JOIN r04_prop_unit r04 on r04.r01_id!=r01.r01_id
WHERE r04.c01_id=(select c01_id from c01_ganaderos where user_id='".$prod."') AND*/ WHERE r01_clave LIKE '".$q."%' 
LIMIT 20
");
            $data = $query->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Upp::findOne($id)->r01_clave];
        }
        return $out;
    }

    public function actionGetunidades($prod){
        $op =  PropietarioUnidad::find()->where('c01_id=:id', ['id'=>$prod])->all();
        $ops = "<option value=''>Seleccionar Unidad...</option>";
        foreach($op as $o){
            $cons = Upp::findOne($o->r01_id);
            $ops .= "<option value='" . $cons->r01_id . "'>" .$cons->r01_clave.' - '.$cons->r01_nombre."</option>";
        }
        return $ops;
    }
    public function actionProductororigenunico($prod){
        $productores =  PropietarioUnidad::find()->where('c01_id=:id', ['id'=>$prod]);
        if($productores->count()==1){
            foreach ($productores->all() as $pp){
                return $pp->r01_id;
            }
        }else{
            return false;
        }
    }

    public function actionUnidadorigen($id){
        $arr[0] = '';

        $unidad = Upp::findOne($id);
        if($unidad){
            $estatus = 'LIBRE DE CUARENTENA';
            /*if($unidad->r01_estatus_unidad==1)
                $estatus = 'LIBRE DE CUARENTENA';
            else if($unidad->r01_estatus_unidad==2)
                $estatus = 'CUARENTENA PRECAUTORIA';
            else if($unidad->r01_estatus_unidad==3)
                $estatus = 'CUARENTENA DEFINITVA';*/
            $arr[1] = $estatus;//estatus sanitario
            $arr[2] = $unidad->r01_latitud ? $unidad->r01_latitud : '';//latitud
            $arr[3] = $unidad->r01_longitud ? $unidad->r01_longitud : '';//longitud
        }

        return json_encode($arr);
    }

    public function actionUnidaddestino($id){
        $relacion = PropietarioUnidad::find()->where('r01_id=:id', [':id'=>$id])->one();

        $arr[0] = '';

        $unidad = Upp::findOne($id);
        if($unidad){
            $arr[1] = $unidad->r01_calle ? $unidad->r01_calle : '';
            $arr[2] = $unidad->r01_colonia ? $unidad->r01_colonia : '';
            $arr[3] = $unidad->r01_cp ? $unidad->r01_cp : '';
            //Obtener el nombre del estado
            if($unidad->r01_estado){
                $edo = Estados::findOne($unidad->r01_estado);
                if($edo)
                    $arr[4] = $edo->c02_nom_ent;
            }else{
                $arr[4] = '';
            }
            //Obtener la descripción del municipio
            if($unidad->r01_municipio){
                $mpo = Municipios::findOne($unidad->r01_municipio);
                if($mpo)
                    $arr[5] = $mpo->c03_nom_mun;
            }else{
                $arr[5] = '';
            }
            //Obtener la descripción de la localidad
            if($unidad->r01_localidad){
                $loc = LocalidadesZac::findOne($unidad->r01_localidad);
                if($loc)
                    $arr[6] = $loc->c04_nom_loc;
            }else{
                $arr[6] = '';
            }

            $estatus = 'LIBRE DE CUARENTENA';
            /*
            if($unidad->r01_estatus_unidad==1)
                $estatus = 'LIBRE DE CUARENTENA';
            else if($unidad->r01_estatus_unidad==2)
                $estatus = 'CUARENTENA PRECAUTORIA';
            else if($unidad->r01_estatus_unidad==3)
                $estatus = 'CUARENTENA DEFINITVA';*/
            $arr[7] = $estatus;//estatus sanitario
            $arr[8] = $unidad->r01_latitud ? $unidad->r01_latitud : '';//latitud
            $arr[9] = $unidad->r01_longitud ? $unidad->r01_longitud : '';//longitud

        }

        return json_encode($arr);
    }
    public function actionBuscarrelacion($usuario){
        $prod = Ganaderos::find()->where('user_id=:usr', [':usr'=>$usuario])->one();
        //return sizeof($prod);
        if($prod){
            $relaciones = PropietarioUnidad::find()->where('c01_id=:id',[':id'=>$prod->c01_id])->count();
            if($relaciones=='0')
                return $prod->c01_id;
            else
                return -1;
        }else
            return -1;
    }
    public function actionAgregararete($numero, $edad, $raza, $raza2, $sexo, $especie, $solicitud){
        $arete_int = new ExportacionAretes();
        $busqueda = Aretes::find()
            ->where('r02_numero=:num', [':num'=>$numero])
            ->andWhere('r02_especie=:esp', [':esp'=>$especie])
            ->one();
        if($solicitud==-1)
            $arete_int->p11_id = null;
        else
            $arete_int->p11_id = $solicitud;


        if($busqueda)
            $arete_int->r02_id = $busqueda->r02_id;
        else
            $arete_int->r02_id = 20876;
        $arete_int->r28_numero = $numero;
        $arete_int->r28_edad = $edad;
        $arete_int->r28_raza = $raza;
        $arete_int->r28_raza2 = $raza2;
        $arete_int->r28_sexo = $sexo;
        $arete_int->r28_especie = $especie;
        $arete_int->r28_usuAlta = Yii::$app->user->getId();
        if($arete_int->save())
            return 1;
        else
            return 0;
    }

    public function  actionGetunidad($usuario){
        $query = \app\models\Upp::findBySql("
SELECT 
*
FROM r01_upp r01
JOIN r04_prop_unit r04 on r04.r01_id=r01.r01_id
WHERE r04.c01_id=(select c01_id from c01_ganaderos where user_id='".$usuario."') 
")->one();
        if($query)
            return $query->r01_id;
        else
            return 0;
    }

    public function actionGetaretebus($arete, $especie){
        $arete = Aretes::find()->where('r02_numero=:numero', [':numero'=>$arete])->andWhere('r02_especie=:especie',[':especie'=>$especie])->one();

        if($arete){
            $arr[0] = $arete->r02_edad;
            $arr[1] = $arete->r02_raza;
            $arr[2] = $arete->r02_raza2;
            $arr[3] = $arete->r02_sexo;
            return json_encode($arr);
        }else{
            //return false;
            $arr[0] = false;
            return json_encode($arr);
        }

    }

    public function actionExistearete($numero, $especie, $solicitud){
        if($solicitud==-1){
            $registros = ExportacionAretes::find()
                ->where('r28_numero=:num', [':num'=>$numero])
                ->andWhere('r28_especie=:esp', [':esp'=>$especie])
                ->andWhere(['r28_usuAlta'=>Yii::$app->getUser()->getId()])
                ->andWhere('p11_id is null')
                ->count();
        }else{
            $registros = ExportacionAretes::find()
                ->where('r28_numero=:num', [':num'=>$numero])
                ->andWhere('r28_especie=:esp', [':esp'=>$especie])
                ->andWhere('p11_id=:sol', [':sol'=>$solicitud])
                ->count();
        }

        if($registros>0)
            return 1;
        else
            return 0;

    }

}




//
