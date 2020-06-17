<?php

namespace app\controllers;

use app\models\ConfiguracionesReporte;
use app\models\Users;
use app\models\Utileria;
use Yii;
use app\models\PerfilUsuario;
use app\models\search\PerfilUsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PerfilUsuarioController implements the CRUD actions for PerfilUsuario model.
 */
class PerfilUsuarioController extends Controller
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
     * Lists all PerfilUsuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PerfilUsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PerfilUsuario model.
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
     * Creates a new PerfilUsuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PerfilUsuario();
        $modelUser = new Users();
        $msg="";
        if ($model->load(Yii::$app->request->post()) && $modelUser->load(Yii::$app->request->post())) {
            $table = Users::find()->where("email=:email", [":email" => $modelUser->email]);
            //Revisar si existe el email ingresado
            if ($table->count() == 1){
                $msg = "El email ya existe, intenta otro.";
                return $this->render('create', [
                    'model' => $model,
                    'modelUser' => $modelUser,
                    'msg'=>$msg,
                ]);
            }

            $table=Yii::$app->db->createCommand('SELECT * FROM c05_mvz WHERE c05_usuario="'.$modelUser->username.'"')->queryAll();
            if (count($table) == 1){
                $msg = "El usuario ya existe, intenta otro.";
                return $this->render('create', [
                    'model' => $model,
                    'modelUser' => $modelUser,
                    'msg'=>$msg,
                ]);
            }

            $model->a02_email=$modelUser->email;
            $pass=$modelUser->password;
            $modelUser->password = Utileria::encrypt($pass);
            $modelUser->password_repeat = Utileria::encrypt($pass);
            $modelUser->authKey = $this->randKey("abcdef0123456789", 200);
            $modelUser->accessToken = $this->randKey("abcdef0123456789", 200);
            $modelUser->activate=1;
            $modelUser->verification_code=$this->randKey("abcdef0123456789", 8);
            $modelUser->role=0;

            if ($modelUser->save()) {
                $model->a01_id=$modelUser->id;
                $model->a02_usuAlta=Yii::$app->user->getId();
                if($model->save()){
                    $reporte = new ConfiguracionesReporte();
                    $reporte->user = $modelUser->id;
                    $reporte->r08_left = 12;
                    $reporte->r08_up = 35;
                    $reporte->save();
                }else{
                    foreach ($model->getFirstErrors() as $f){
                        //return var_dump($f);
                    }
                }
                return $this->redirect(['list']);
            } else {
                $modelUser->password=$pass;
                return $this->render('create', [
                    'model' => $model,
                    'modelUser' => $modelUser,
                    'msg'=>$msg,
                ]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'modelUser' => $modelUser,
                'msg'=>$msg,
            ]);
        }
    }

    /**
     * Updates an existing PerfilUsuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $msg=null;
        $model = $this->findModel($id);
        $modelUser = Users::findOne($model->a01_id);
        $modelUser->password_repeat=$modelUser->password;

        if ($model->load(Yii::$app->request->post()) && $modelUser->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->a02_id]);
            $table = Users::find()->where("email=:email", [":email" => $modelUser->email]);
            //Si el email existe mostrar el error
            if ($table->count() >= 1){
                if($table->count()==1){
                    if($table->one()->id==$modelUser->id){

                    }else{
                        $msg = "El email ya existe, intenta otro.";
                        return $this->render('update', [
                            'model' => $model,
                            'modelUser' => $modelUser,
                            'msg'=>$msg,
                        ]);
                    }
                }else{
                    $msg = "El email ya existe, intenta otro.";
                    return $this->render('update', [
                        'model' => $model,
                        'modelUser' => $modelUser,
                        'msg'=>$msg,
                    ]);
                }
            }
            //$table = Users::find()->where("username=:username", [":username" => $modelUser->username]);
            $table=Yii::$app->db->createCommand('SELECT * FROM c05_mvz WHERE c05_usuario="'.$modelUser->username.'"')->queryAll();
            //Si el email existe mostrar el error
            if(count($table) >= 1){
                if(count($table) == 1){
                    if($table[0]['id']=='1'.$modelUser->id){

                    }else{
                        $msg = "El usuario ya existe, intenta otro.";
                        return $this->render('update', [
                            'model' => $model,
                            'modelUser' => $modelUser,
                            'msg'=>$msg,
                        ]);
                    }
                }else{
                    $msg = "El usuario ya existe, intenta otro.";
                    return $this->render('update', [
                        'model' => $model,
                        'modelUser' => $modelUser,
                        'msg'=>$msg,
                    ]);
                }
            }
            $table = Users::findOne($model->a01_id);
            if (!($modelUser->password===$table->password)) {
                $pass=$modelUser->password;
                $modelUser->password = Utileria::encrypt($pass);
                $modelUser->password_repeat=$modelUser->password;
            }
            $model->a02_email=$modelUser->email;

            $modelUser->activate = $model->a02_activo;
            $modelUser->save();
            $model->a02_fecMod = Utileria::horaFechaActual();
            $model->a02_usuMod = Yii::$app->user->getId();
            $model->save();
            if($model->a02_id===Yii::$app->user->id){
                return $this->redirect(['index']);
            }else{
                return $this->redirect(['list']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelUser' => $modelUser,
                'msg'=>$msg,
            ]);
        }
    }

    /**
     * Deletes an existing PerfilUsuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $us = Users::findOne($model->a01_id);
        $us->activate=-1;
        $us->save(false);
        $model->a02_activo=-1;
        $model->save();
        return $this->redirect(['list']);
    }
    /**
     * Finds the PerfilUsuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PerfilUsuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerfilUsuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionList(){
        $searchModel = new PerfilusuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    private function randKey($str = '', $long = 0) {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str) - 1;
        for ($x = 0; $x < $long; $x++) {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
}
