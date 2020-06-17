<?php

namespace app\controllers;

use app\models\Brucelosis;
use app\models\ConfiguracionesReporte;
use app\models\Folios;
use app\models\Medicos;
use app\models\PerfilUsuario;
use app\models\Tuberculosis;
use app\models\User;
use app\models\Vacunacion;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Aretes;
use app\models\Upp;
use app\models\Razas;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }
        $medico=Yii::$app->session['medico'];

        if(isset($medico)){
            return $this->render('mvz', [
                'medico'=>$medico,
            ]);
        }

        if(User::isUserMedico(Yii::$app->user->getId())){
            $med = Medicos::findOne(PerfilUsuario::find()->where('a01_id=:id', [':id'=>Yii::$app->user->getId()])->one()->c05_id);
            if($med->c05_activo!=1){
                Yii::$app->user->logout();
                return Yii::$app->response->redirect(Url::toRoute(['site/login', 'show'=>1]));
            }
        }
        return $this->render('index');
    }
    public function actionMvz()
    {

        return $this->render('mvz',[
            'medico' => Medicos::findOne(203),
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin($show=0)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        if($show==1){
            Yii::$app->getSession()->setFlash('error', 'Tu usuario ha sido temporalmente suspedido debido a la expiración de tu licencia. Contacta al administrador del sistema, o escribenos a contacto@sifope.mx');
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        //return $this->goHome();
        return Yii::$app->response->redirect(Url::toRoute(['site/login']));
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionConfiguracion($valor){
        $where=true;
        $direccion = true;
        switch ($valor){
            case 0: $where=true;
                    $direccion=false;
            break;
            case 1: $where=false;
                $direccion=false;
                break;
            case 2: $where=false;
                $direccion=true;
                break;
            case 3: $where=true;
                $direccion=true;
                break;

        }

        $margenes = ConfiguracionesReporte::find()->where('user=:id', [':id'=>Yii::$app->user->getId()])->one();
        if($margenes){
            if($where){
                if($direccion){
                    $margenes->r08_up = $margenes->r08_up+1;
                }else{
                    $margenes->r08_up = $margenes->r08_up-1;
                }

            }else{
                if($direccion){
                    $margenes->r08_left = $margenes->r08_left+1;
                }else{
                    $margenes->r08_left = $margenes->r08_left-1;
                }

            }
            $margenes->save();
        }else{
            $new_conf = new ConfiguracionesReporte();
            $new_conf->user = Yii::$app->user->getId();
            $new_conf->r08_up = $where?($direccion?11:9):10;
            $new_conf->r08_left = $where?10:($direccion?11:9);
            $new_conf->save();
        }
    }

    public function actionReportes($tipo=null, $upp=null, $arete=null, $imprimir = 0, $especie=null){


        if ($tipo!=null) {
            if($tipo==4){
                Yii::$app->getSession()->setFlash('error', 'Folio no existente.');
                return $this->render('reportes', [
                    'tipo' => null,
                ]);
            }
            if($tipo==3){

                return $this->render('reportes', [
                    'tipo' => $tipo,
                    'upp'=>null,
                    'arete'=>$arete,
                    'imprimir'=>$imprimir,
                ]);
            }
            $aretes = Aretes::getAretesPorUppOnly($upp);


            return $this->render('reportes', [
                'tipo' => $tipo,
                'especie' => $especie,
                'arete'=>$arete,
                'aretes'=>$aretes,
                'upp'=>Upp::findOne($upp),
                'imprimir'=>$imprimir,
            ]);
        } else {

            return $this->render('reportes', [
                'tipo' => null,
            ]);
        }

    }

    public function actionConsultararete(){
        return $this->render('consultaaretes', []);
    }

    public function actionEditararete(){
        return $this->render('editararete', []);
    }
    public function actionFolios($status=0, $isin =0, $id=0, $tipo=0, $upp=0){
        Yii::$app->getSession()->setFlash('success', 'Folio existente.');
        return $this->render('folios', [
            'status' => $status,
            'isin' => $isin,
            'id' => $id,
            'tipo' => $tipo,
            'upp' => $upp,
        ]);
    }

    public function actionGetareteupp($arete, $especie){
        $arete = Aretes::find()->where('r02_numero=:numero', [':numero'=>$arete])->andWhere('r02_especie=:especie',[':especie'=>$especie])->one();
        //$arr = array();
        if($arete) {
            $upp = Upp::find()->where('r01_id=:id', [':id'=>$arete->r01_id])->one();
            $raza  = Razas::find()->where('c06_id=:id', [':id'=>$arete->r02_raza])->one();
            $raza2 = Razas::find()->where('c06_id=:id', [':id'=>$arete->r02_raza2])->one();

            $arr[0] = $arete->r02_edad;
            $arr[1] = $raza->c06_clave;
            if($raza2)
                $arr[2] = $raza2->c06_clave;
            else
                $arr[2] = "";
            $arr[3] = $arete->r02_sexo;
            if($upp)
                $arr[4] = $upp->r01_clave;
            else {
                $upp_ant = Upp::find()->where('r01_id=:id', [':id'=>$arete->p01_upp_anterior])->one();
                if($upp_ant)
                    $arr[4] = $upp_ant->r01_clave;
                else
                    $arr[4] = 'SIN UPP';
            }
        }else{
            $arr[0] = "";
            $arr[1] = "";
            $arr[2] = "";
            $arr[3] = "-1";
            $arr[4] = "";
        }
        return json_encode($arr);
    }
    public function actionCheck_folio($folio){
        $bus_tb = Tuberculosis::find()->where('p03_folio=:folio', [':folio'=>$folio])->one();
        $bus_br =Brucelosis::find()->where('p03_folio=:folio', [':folio'=>$folio])->one();
        $bus_vc = Vacunacion::find()->where('p03_folio=:folio', [':folio'=>$folio])->one();
        $bus_folios = Folios::find()->where('r08_folio=:folio', [':folio'=>$folio])->one();
        $whereis=0;

        if($bus_br){
            $whereis=1;
        }elseif ($bus_tb){
            $whereis=2;
        }elseif ($bus_vc){
            $whereis=3;
        }elseif ($bus_folios){
            $whereis=4;
        }

        /**
         * res[0] = Status
         * res[1] = Donde se encuentra
         * res[2] = Id relacionado
         */

        switch ($whereis){
            case 0: //Folio no existente
                $res[0]=0;
                $res[1]=0;
                $res[2]=0;
                break;
            case 1: //Folio en BR
                $res[0]=1;
                $res[1]=$whereis;
                $res[2]=$bus_br->p03_id;
                break;
            case 2: //Folio en TB
                $res[0]=1;
                $res[1]=$whereis;
                $res[2]=$bus_tb->p03_id;
                break;
            case 3: //Folio en VC
                $res[0]=1;
                $res[1]=$whereis;
                $res[2]=$bus_vc->p03_id;
                break;
            case 4: //Folio en TB
                $res[0]=1;
                $res[1]=$whereis;
                $res[2]=$bus_folios->r08_id;
                break;
            default:
                $res[0]=0;
                $res[1]=0;
                $res[2]=0;
                break;

        }

        return json_encode($res);

    }
}
