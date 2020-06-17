<?php

namespace app\controllers;

use app\models\Aretes;
use app\models\Utileria;
use Yii;
use app\models\Upp;
use app\models\search\UppSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UppController implements the CRUD actions for Upp model.
 */
class UppController extends Controller
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
        $searchModel = new UppSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = Upp::getUppsMostrar();

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
        $dataProvider = Aretes::getAretes();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' =>$dataProvider,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->r01_id]);
            $model->r01_usuAlta = Yii::$app->user->getId();
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Upp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dataProvider = Aretes::getAretes();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->r01_id]);
            $model->r01_fecMod = Utileria::horaFechaActual();
            $model->r01_usuMod = Yii::$app->user->getId();
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataProvider' =>$dataProvider,
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
        $this->findModel($id)->delete();

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

    public static function actionValidarclave($cve){
        $bus = Upp::find()->where('r01_clave=:clave',[':clave'=>$cve])->one();

        if($bus)
            return true;
        else
            return false;
    }

    public function actionRevisarclave($clave){
        $bus = Upp::find()->where('r01_clave=:cl', [':cl'=>$clave])->one();
        if($bus){
            return $bus->r01_id;
        }else{
            return -1;
        }
    }


}
