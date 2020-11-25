<?php

namespace app\controllers;

use app\models\Aretes;
use app\models\ExportacionAretes;
use app\models\SolicitudesExportacionesAretes;
use Yii;
use app\models\SolicitudesExportaciones;
use app\models\search\SolicitudesExportacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SolicitudesExportacionesController implements the CRUD actions for SolicitudesExportaciones model.
 */
class SolicitudesExportacionesController extends Controller
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
     * Lists all SolicitudesExportaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SolicitudesExportacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SolicitudesExportaciones model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAgregararete($numero, $solicitud){
        $arete_int = new SolicitudesExportacionesAretes();
        $busqueda = ExportacionAretes::find()
            ->where('r28_numero=:num', [':num'=>$numero])
            ->one();
        if($solicitud==-1)
            $arete_int->p12_id = null;
        else
            $arete_int->p12_id = $solicitud;

        if($busqueda){
            $arete_int->r28_id = $busqueda->r28_id;
            $arete_int->r29_resultado = 1;
            $arete_int->r29_usuAlta = Yii::$app->user->getId();
        }else{
            $arete_int->r29_resultado = 0;
            $arete_int->r28_id = null;
            $arete_int->r29_usuAlta = Yii::$app->user->getId();
        }
        if($arete_int->save())
            return 1;
        else
            return var_dump($arete_int->errors);
    }

    public function actionExistearete($numero, $solicitud){
        if($solicitud==-1){
            $busqueda = ExportacionAretes::find()
                ->where('r28_numero=:num', [':num'=>$numero])
                ->one();

            if($busqueda){
                $registros = SolicitudesExportacionesAretes::find()
                    ->where('r29_id=:num', [':num'=>$busqueda->r28_id])
                    ->andWhere(['r29_usuAlta'=>Yii::$app->getUser()->getId()])
                    ->andWhere('p12_id is null')
                    ->count();
            }else{
                return 2;
            }

        }else{
            $registros = SolicitudesExportacionesAretes::find()
                ->where('r29_id=:num', [':num'=>$busqueda->r28_id])
                ->andWhere('p12_id=:sol', [':sol'=>$solicitud])
                ->count();
        }

        if($registros>0)
            return 1;
        else
            return 0;

    }
    /**
     * Creates a new SolicitudesExportaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SolicitudesExportaciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->p12_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SolicitudesExportaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->p12_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SolicitudesExportaciones model.
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
     * Finds the SolicitudesExportaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SolicitudesExportaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SolicitudesExportaciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
