<?php

namespace app\controllers;

use app\models\Ganaderos;
use app\models\Grupos;
use app\models\PropietarioUnidad;
use app\models\Utileria;
use Yii;
use app\models\Upp;
use app\models\search\UnidadesSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LocalidadesZac;
use app\models\Municipios;
use app\models\Zonas;

/**
 * UnidadesController implements the CRUD actions for Upp model.
 */
class UnidadesController extends Controller
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
     * Lists all Upp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UnidadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Upp model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $relaciones = PropietarioUnidad::getPropPerUnidad($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'relaciones' => $relaciones,
        ]);
    }

    /**
     * Creates a new Upp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Upp();
        $relaciones = PropietarioUnidad::getRelacionesNulasUnidades();

        //Eliminar relaciones erroneas
        $query = Yii::$app->db->createCommand(
            "DELETE FROM r04_prop_unit WHERE (c01_id is null or r01_id is null)"
        )->query();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->r01_id]);
            $arr_r04id = PropietarioUnidad::find()->where('r01_id is null')
                ->andWhere('r04_usuAlta=:usu', [':usu'=>Yii::$app->user->getId()])->all();
            foreach ($arr_r04id as $ar){
                $rel = PropietarioUnidad::findOne($ar->r04_id);
                $rel->r01_id=$model->r01_id;
                $rel->save();
            }

            $model->r01_nombre = strtoupper($model->r01_nombre);
            $model->r01_superficie = strtoupper($model->r01_superficie);
            $model->r01_calle = strtoupper($model->r01_calle);
            $model->r01_colonia = strtoupper($model->r01_colonia);
            $model->r01_usuAlta = Yii::$app->user->getId();
            $model -> save();
            Yii::$app->getSession()->setFlash('success', 'La información se guardó correctamente.');
            return $this->redirect(['create']);
        } else {
            if (!isset($_GET['_pjax'])) {
                $this->borrarRelacionesNulas();
            }
            return $this->render('create', [
                'model' => $model,
                'relaciones'=>$relaciones,
            ]);
        }
    }

    public function borrarRelacionesNulas()
    {
        $aretes = PropietarioUnidad::find()->where('r01_id is NULL')->andWhere('r04_usuAlta=:user', [':user'=>Yii::$app->user->getId()])->all();
        foreach ($aretes as $a) {
            $a->delete();
        }
    }
    /**
     * Updates an existing Upp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $edicion=0)
    {
        $model = $this->findModel($id);
        $relaciones = PropietarioUnidad::getPropPerUnidad($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->r01_id]);
            $model->r01_nombre = strtoupper($model->r01_nombre);
            $model->r01_superficie = strtoupper($model->r01_superficie);
            $model->r01_calle = strtoupper($model->r01_calle);
            $model->r01_colonia = strtoupper($model->r01_colonia);
            $model->r01_fecMod = Utileria::horaFechaActual();
            $model->r01_usuMod = Yii::$app->user->getId();
            $model -> save();
            if($edicion!=0){
                return $this->redirect(['ganaderos/update', 'id'=>$edicion]);
            }else{
                Yii::$app->getSession()->setFlash('success', 'La información se guardó correctamente.');
                return $this->redirect(['create']);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
                'relaciones'=>$relaciones,
            ]);
        }
    }

    /**
     * Deletes an existing Upp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $registro = $this->findModel($id);
        $registro->r01_mostrar=-1;
        $registro->save();


        return $this->redirect(['index']);
    }

    /**
     * Finds the Upp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Upp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Upp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAdd_productor($indicador)
    {


        $model = new PropietarioUnidad();

        if ($model->load(Yii::$app->request->post())) {

           // $ver = PropietarioUnidad::find()->where('c01_id=:id AND (r01_id is NULL OR r01_id=:movimiento)',[':id'=>$model->c01_id,':movimiento'=>$indicador]);

            if ($indicador != -1) {
                $ver = PropietarioUnidad::find()->where('c01_id=:id AND (r01_id is NULL OR r01_id=:movimiento)',[':id'=>$model->c01_id,':movimiento'=>$indicador]);
            } else {
                $ver = PropietarioUnidad::find()->where('c01_id=:id AND (r01_id is NULL OR r01_id=:movimiento)',[':id'=>$model->c01_id,':movimiento'=>$indicador]);
                $ver->andWhere('r04_usuAlta=:usu', [':usu'=>Yii::$app->user->getId()]);
            }

            if($indicador!=-1){
                $model->r01_id=$indicador;
            }
            $model->r04_usuAlta= Yii::$app->user->getId();

            if ($ver->count() > 0) {
                $error = 1;
                $mensaje = 'Error: el propietario ya existe';
            } else {

                if($model->c01_id!=null){
                    if ($model->save()) {
                        $mensaje = 'Guardado correctamente ';
                        $error = 0;
                    } else {
                        $error = 1;
                        //$mensaje = 'Error: ' . $model->getErrors('a02_id')[0];
                        // $mensaje = $model->getFirstErrors();
                        foreach($model->getFirstErrors() as $er){
                            $mensaje = $er." ";
                        }
                    }
                }else{
                    $error = 1;
                    $mensaje = 'Error: Debes ingresar un propietario';
                }


            }
            $respuesta = ['error' => $error, 'msj' => $mensaje];
            $respuesta = json_encode($respuesta);

            echo "var accion = $.extend({},{$respuesta})";

            Yii::$app->end();
        } else {
            $items = Ganaderos::getAllGanaderosCURP();
            return $this->renderAjax('_addproductor', ['model' => $model, 'items' => $items, 'indicador' => $indicador]);
        }
    }
    public function actionDelete_productor($id) {

        $p=PropietarioUnidad::findOne($id);
        if ($p->delete()) {
            $mensaje = 'Eliminado correctamente';
            $error = 0;
        } else {
            $error = 1;
            $mensaje = 'Ocurrio un error';
        }

        $respuesta = ['error' => $error, 'msj' => $mensaje];
        $respuesta = json_encode($respuesta);

        //echo "var accion = $.extend({},{$respuesta})";
        return $this->redirect(Yii::$app->request->referrer);
        Yii::$app->end();

    }

    public static function actionCargarmunicipios($edo){
        $mpo = Municipios::getMunicipiosPorEdo($edo);
        echo "<option value=''>Seleccionar municipio...</option>";
        foreach($mpo as $key => $value){
            $mun = Municipios::findOne($key);
            echo "<option value='" . $mun->c03_id . "'>" . $mun->c03_nom_mun ."</option>";
        }
    }

    public static function actionCargarlocalidades($edo, $mpo){
        $loc = LocalidadesZac::getLocalidadesPorMun($edo, $mpo);
        echo "<option value=''>Seleccionar localidad...</option>";
        foreach($loc as $key => $value){
            $loca = LocalidadesZac::findOne($key);
            echo "<option value='" . $loca->c04_id . "'>" . $loca->c04_nom_loc ."</option>";
        }
    }

    public function actionCrearlocalidad($edo, $mun, $nom_loc)
    {
        $existe = LocalidadesZac::find()->where('c04_nom_loc=:nom_loc',[':nom_loc'=>$nom_loc])->andWhere('c04_cve_ent=:ent',[':ent'=>$edo])->andWhere('c04_cve_mun=:mun',[':mun'=>$mun])->one();
        if(!$existe){
            $model = new LocalidadesZac();
            $id_mun = Municipios::findOne($mun);

            $model -> c04_cve_ent =  $edo;
            $model -> c04_cve_mun = $id_mun->c03_cve_mun;
            $model -> c04_nom_loc = strtoupper($nom_loc);
            $max =  LocalidadesZac::find()->where('c04_cve_ent=:ent',[':ent'=>$edo])->andWhere('c04_cve_mun=:mun',[':mun'=>$id_mun->c03_cve_mun])->orderBy('c04_cve_loc DESC')->one();
            if(!$max){
                $model -> c04_cve_loc = 1;
            }else
                $model -> c04_cve_loc = $max -> c04_cve_loc+1;
            if($model->save()){
                return $model -> c04_id;
            }else{
                foreach ($model-> getFirstErrors() as $error){
                    return var_dump($error);
                }
                return -1;
            }
        }else
            return -2;

    }
    public function actionUpplistresenas($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $grupos = Grupos::getUsuarios();
            if($grupos->count()>0){
                $usuario = '(';
                $cont = 0;
                foreach ($grupos->all() as $gr){
                    if($cont==1)
                        $usuario .= ' || ';
                    $usuario .= 'p01_usuarioCreate='.$gr->a01_id;
                    $cont = 1;
                }
                $usuario .= ')';
            }
            else{
                $usuario = 'p01_usuarioCreate='.Yii::$app->user->getId();
            }

            $query = new Query();
            $query->select('r01_id as id, r01_clave AS text')
                ->from('r01_upp')
                ->where(['like', 'r01_clave', $q])
                ->andWhere('r01_id in (SELECT p01_upp from p01_resenas WHERE '.$usuario.')')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Upp::findOne($id)->r01_clave];
        }
        return $out;
    }


    public function actionCuarentena(){

    }
    public function actionCheckrelaciones($id){
        $test=null;
        if($id!=-1){
            $relaciones = PropietarioUnidad::find()->where('r01_id=:id', [':id'=>$id])->all();
        }else{
            $relaciones = PropietarioUnidad::find()->where('r01_id is null')->all();
        }

        if($relaciones){
            return 1;
        }else{
            return 2;
        }
    }

    public static function actionCargarzona($mpo, $clave){
        $upp = Upp::find()->where('r01_clave=:cve', [':cve'=>$clave])->one();
        $zona = Municipios::find()->where('c03_id=:id', [':id'=>$mpo])->one();
        if($upp)
            return $upp->r01_zona;
        else
            if($zona)
                return $zona->c03_zona;
    }
}
