<?php

namespace app\controllers;

use app\models\PropietarioUnidad;
use app\models\Upp;
use Yii;
use app\models\Ganaderos;
use app\models\search\GanaderosSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LocalidadesZac;
use app\models\Municipios;

/**
 * GanaderosController implements the CRUD actions for Ganaderos model.
 */
class GanaderosController extends Controller
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
     * Lists all Ganaderos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GanaderosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ganaderos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $relaciones = PropietarioUnidad::getUnidPerPropietario($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'relaciones'=>$relaciones,
        ]);
    }

    //Borra aretes que no tienen ninguna upp asignada.
    public function borrarRelacionesNull()
    {
        $aretes = PropietarioUnidad::find()->where('c01_id is NULL')->andWhere('r04_usuAlta=:user', [':user'=>Yii::$app->user->getId()])->all();
        foreach ($aretes as $a) {
            $a->delete();
        }
    }
    /**
     * Creates a new Ganaderos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ganaderos();
        $relaciones = PropietarioUnidad::getRelacionesNulas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $arr_r04id = PropietarioUnidad::find()->where('c01_id is null')
                    ->andWhere('r04_usuAlta=:usu', [':usu'=>Yii::$app->user->getId()])->all();
                foreach ($arr_r04id as $ar){
                    $rel = PropietarioUnidad::findOne($ar->r04_id);
                    $rel->c01_id=$model->c01_id;
                    $rel->save();
                }

            //return $this->redirect(['view', 'id' => $model->c01_id]);
            $model->c01_nombre = strtoupper(trim($model->c01_nombre));
            $model->c01_apaterno = strtoupper(trim($model->c01_apaterno));
            $model->c01_amaterno = strtoupper(trim($model->c01_amaterno));
            $model->c01_curp = strtoupper(trim($model->c01_curp));
            $model->c01_rfc = strtoupper(trim($model->c01_rfc));
            $model->c01_colonia = strtoupper(trim($model->c01_colonia));
            $model->c01_calle = strtoupper(trim($model->c01_calle));
            $model->c01_correo = strtoupper(trim($model->c01_correo));
            $model -> save();
            Yii::$app->getSession()->setFlash('success', 'La información se guardó correctamente.');
            return $this->redirect(['create']);
        } else {
            if (!isset($_GET['_pjax'])) {
                $this->borrarRelacionesNull();
            }
            return $this->render('create', [
                'model' => $model,
                'relaciones'=>$relaciones,
            ]);
        }
    }

    /**
     * Updates an existing Ganaderos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $edicion=0)
    {
        $model = $this->findModel($id);
        $relaciones = PropietarioUnidad::getUnidPerPropietario($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->c01_id]);
            $model->c01_nombre = strtoupper($model->c01_nombre);
            $model->c01_apaterno = strtoupper($model->c01_apaterno);
            $model->c01_amaterno = strtoupper($model->c01_amaterno);
            $model->c01_curp = strtoupper($model->c01_curp);
            $model->c01_rfc = strtoupper($model->c01_rfc);
            $model->c01_colonia = strtoupper($model->c01_colonia);
            $model->c01_calle = strtoupper($model->c01_calle);
            $model->c01_correo = strtoupper($model->c01_correo);
            $model -> save();
            if($edicion!=0){
                return $this->redirect(['unidades/update', 'id'=>$edicion]);
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
     * Deletes an existing Ganaderos model.
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
     * Finds the Ganaderos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ganaderos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ganaderos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function actionCargarmunicipiosproductor($edo){
        $mpo = Municipios::getMunicipiosPorEdo($edo);

        echo "<option value=''>Seleccionar municipio...</option>";
        foreach($mpo as $key => $value){
            $mun = Municipios::findOne($key);
            echo "<option value='" . $mun->c03_id . "'>" . $mun->c03_nom_mun ."</option>";
        }
    }

    public static function actionCargarlocalidadesproductor($edo, $mpo){
        $loc = LocalidadesZac::getLocalidadesPorMun($edo, $mpo);
        echo "<option value=''>Seleccionar localidad...</option>";
        foreach($loc as $key => $value){
            $loca = LocalidadesZac::findOne($key);
            echo "<option value='" . $loca->c04_id . "'>" . $loca->c04_nom_loc ."</option>";
        }
    }

    public static function actionValidarcurp($curp){
        $bus = Ganaderos::find()->where('c01_curp=:curp_bus',[':curp_bus'=>$curp])->one();

        if($bus)
            return true;
        else
            return false;
    }

    public static function actionValidarrfc($rfc){
        $bus = Ganaderos::find()->where('c01_rfc=:rfc_bus',[':rfc_bus'=>$rfc])->one();

        if($bus)
            return true;
        else
            return false;
    }
    public function actionRevisarcurp($curp){
        $bus = Ganaderos::find()->where('c01_curp=:cu', [':cu'=>$curp])->one();
        if($bus){
            return $bus->c01_id;
        }else{
            return -1;
        }
    }
    public function actionRevisarrfc($rfc){
        $bus = Ganaderos::find()->where('c01_rfc=:cu', [':cu'=>$rfc])->one();
        if($bus){
            return $bus->c01_id;
        }else{
            return -1;
        }
    }

    public function actionAdd_unidad($indicador)
    {
        $model = new PropietarioUnidad();

        if ($model->load(Yii::$app->request->post())) {

            if ($indicador != -1) {
                 $ver = PropietarioUnidad::find()->where('r01_id=:id AND (c01_id is NULL OR c01_id=:movimiento)',[':id'=>$model->r01_id,':movimiento'=>$indicador]);
            } else {
                $ver = PropietarioUnidad::find()->where('r01_id=:id AND (c01_id is NULL OR c01_id=:movimiento)',[':id'=>$model->r01_id,':movimiento'=>$indicador]);
                $ver->andWhere('r04_usuAlta=:usu', [':usu'=>Yii::$app->user->getId()]);
            }


            if($indicador!=-1){
                $model->c01_id=$indicador;
            }
            $model->r04_usuAlta= Yii::$app->user->getId();

                if ($ver->count() > 0) {
                    $error = 1;
                    $mensaje = 'Error: la unidad ya existe';
                } else {
                    if($model->r01_id!=null){
                        if ($model->save()) {
                            $mensaje = 'Guardado correctamente ';
                            $error = 0;
                        } else {
                            $error = 1;

                            foreach($model->getFirstErrors() as $er){
                                $mensaje = $er." ";
                            }
                        }
                    }else{
                        $mensaje = 'Error: Debes ingresar una unidad.';
                        $error = 1;
                    }


                }


            $respuesta = ['error' => $error, 'msj' => $mensaje];
            $respuesta = json_encode($respuesta);

            echo "var accion = $.extend({},{$respuesta})";

            Yii::$app->end();
        } else {
           // $items = Upp::getUppsOrdenadasSoloClave();
            $items = Upp::getUppsOrdenadasSoloClaveVacio();
            return $this->renderAjax('_addunidad', ['model' => $model, 'items' => $items, 'indicador' => $indicador]);
        }
    }

    public function actionDelete_unidad($id) {
        $p = PropietarioUnidad::findOne($id);
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

    public function actionGanaderoslist(){

            $dropciones = \app\models\Ganaderos::find()->all();
            $i=0;
            foreach ($dropciones as $d){
                $data[$i]['value']=$d->c01_apaterno." ".$d->c01_amaterno." ".$d->c01_nombre;
                $data[$i]['id']=$d->c01_id;
                //$data[$i][0]=$d->c01_nombre;
                $i++;
            }

            return json_encode($data);
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

    public function actionGanlist($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select('c01_id as id, c01_curp AS text')
                ->from('c01_ganaderos')
                ->where(['like', 'c01_curp', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Ganaderos::findOne($id)->c01_curp];
        }
        return $out;
    }
    public function actionGanlistnombre($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select('c01_id as id, concat(c01_nombre, c01_apaterno) AS text')
                ->from('c01_ganaderos')
                ->where(['like', 'c01_nombre', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Ganaderos::findOne($id)->c01_nombre.' '.Ganaderos::findOne($id)->c01_apaterno.' '.Ganaderos::findOne($id)->c01_amaterno];
        }
        return $out;
    }

    public function actionCheckrelaciones($id){
        $test=null;
        if($id!=-1){
            $relaciones = PropietarioUnidad::find()->where('c01_id=:id', [':id'=>$id])->all();
        }else{
            $relaciones = PropietarioUnidad::find()->where('c01_id is null')->all();
        }

        if($relaciones){
            return 1;
        }else{
            return 2;
        }
    }

}
