<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\db\Query;
use common\models\User;
use common\models\City;
use common\models\Station;
use common\models\State;
use common\models\Brand;
use common\models\Register;
use common\models\Reward;
use common\models\Redencion;
use common\models\Code;
use common\models\Campaign;
use backend\models\UserSearch;
use backend\models\RegisterSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'user', 'admin','islero','perfil','redencion','redimir','codigo'],
                'rules' => [
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'admin'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return User::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                       //Los usuarios simples tienen permisos sobre las siguientes acciones
                       'actions' => ['logout', 'user','islero','perfil','redencion','redimir','codigo'],
                       //Esta propiedad establece que tiene permisos
                       'allow' => true,
                       //Usuarios autenticados, el signo ? es para invitados
                       'roles' => ['@'],
                       //Este método nos permite crear un filtro sobre la identidad del usuario
                       //y así establecer si tiene permisos o no
                       'matchCallback' => function ($rule, $action) {
                          //Llamada al método que comprueba si es un usuario simple
                          return User::isUserSimple(Yii::$app->user->identity->id);
                      },
                   ],
                ],
            ],
     //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
     //sólo se puede acceder a través del método post
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        return $this->redirect(['site/login']);

        
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPerfil($id)
    {
        $this->layout = 'main';
        return $this->render('perfil', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'registro';
        $model = new User();
        $modelStation = new Station();
        $modelState = new State();
        $modelCity = new City();



        if ($model->load(Yii::$app->request->post())) {

            $pass = $_POST['User']['password'];
            $statioID = $_POST['Station']['id'];
            $cityID = $_POST['City']['id'];
            $stateID = $_POST['State']['id'];


            $model->status = 10;
            $model->activate = 1;
            $model->role = 1;
            $model->stationId = $statioID;
            $model->setPassword($pass);
            $model->generateAuthKey();
            $model->generateEmailVerificationToken();

            //print_r($_POST);die();

            if ($model->validate()) {

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Gracias por su registro');
                    $identity = $model->findIdentity($model->id);
                    Yii::$app->user->login($identity);
                    return $this->redirect(['islero']);

                } else {

                    Yii::$app->session->setFlash('error', 'Ocurrio un error');
                }
            } else {

                 Yii::$app->session->setFlash('warning', 'Debes ingresar todos los datos');
            }
           
        }

        return $this->render('create', [
            'model' => $model,'modelStation'=>$modelStation,
            'modelState'=>$modelState, 'modelCity'=>$modelCity,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelStation = new Station();
        $modelState = new State();
        $modelCity = new City();

        if(isset($_FILES['User']["name"]["avatar"])){

          //var_dump($_FILES['User']["name"]["avatar"]); die();          
            
              $upload_file = $model->uploadFileAvatar();
              if ($upload_file !== false) {
                    $path = $model->getUploadedFileAvatar();
                    $model->avatar = $path;
                    $upload_file->saveAs($path);
              }
        }

        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->save()){
                return $this->redirect(['islero']);
            }
        }

        return $this->render('update', [
            'model' => $model,'modelStation'=>$modelStation,
            'modelState'=>$modelState, 'modelCity'=>$modelCity,
        ]);
    }

    public function actionIslero(){

        $this->layout = 'main';

        $userId = Yii::$app->user->identity->id;

        $modelRegiter = new Register();
        $countPoint = $modelRegiter->getSumCode();

        $camp = Campaign::find()->where(['activate'=>1])->one();


        return $this->render('islero',['countPoint'=>$countPoint,'camp'=>$camp]);

    }

    public function actionRedencion(){

        $this->layout = 'codigo';
        $modelReward = Reward::find()->all();
        $modelRegiter = new Register();
        //$model = new Reward();
        $countPoint = $modelRegiter->getSumCode();
        $model = new Redencion();


        if ($model->load(Yii::$app->request->post())) {

            //$modelReward->userId = $userId;
            //$modelRegiterCode->codeId = Yii::$app->user->identity->id;

            //print_r($_POST['Redencion']['rewardId']); die();
            

            if ($model->validate()) {
                
            }
           
        }



        return $this->render('redencion',['model'=>$model,'modelReward'=>$modelReward,'countPoint'=>$countPoint]);

    }

    public function actionRedimir($id){

        $this->layout = 'codigo';
        $model = new Redencion();
        $modelRegiter = new Register();
        $countPoint = $modelRegiter->getSumCode();
        $reward = Reward::find()->where(['id'=>$id])->one();
        $point = $reward->puntos;


        $userId = Yii::$app->user->identity->id;

        
        if($id) {
            if ($countPoint >= $point ) {
                $model->rewardId = $id;
                $model->userId = $userId;

                if($model->save()) {

                    return $this->render('redencion-exitoso');
                } 
            } else {

                Yii::$app->session->setFlash('warning', 'No tienes los Puntos suficientes para redimir este premio');
                return $this->redirect(['redencion']);

            }                  
        } else {

            return $this->redirect(['redencion']);
 
        }


    }


    public function actionCodigo(){

        $this->layout = 'codigo';
        $modelRegiterCode = new Register();

        $userId = Yii::$app->user->identity->id;

        //$findCodeUser = Register::find()->where(['userId'=>$userId])->all();
        
        $findCodeUser = new RegisterSearch();
        $dataProvider = $findCodeUser->searchUser($userId);

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $dataProvider->getTotalCount(),
            'pageSize' => 5, //to set count items on one page, if not set will be set from defaultPageSize
            'pageSizeLimit' => [1, 5], //to set range for pageSize
        ]);

        if ($modelRegiterCode->load(Yii::$app->request->post())) {

            $code = Code::find()->where(['cod'=>trim($_POST['Register']['codeId'])])->one();
            if (!empty($code)) {
                $codePoint = $code->point;
                $modelRegiterCode->point = $codePoint;
            }

            $modelRegiterCode->userId = $userId;

            if ($modelRegiterCode->validate()) {
                 //print_r($_POST['User']);
                //die();
                if ($modelRegiterCode->save()) {
                    //Actualizar tabla Código la columna status
                    $code->status = 1;
                    $code->save(false);
                    //Yii::$app->session->setFlash('success', 'Código de registro exitoso!!');
                    
                    return $this->redirect(['registro-exitoso']);

                } else {

                    Yii::$app->session->setFlash('error', 'Ocurrio un error');
                }
            }
           
        }

        return $this->render('codigo',['modelRegiterCode'=>$modelRegiterCode,'dataProvider'=>$dataProvider,'pagination'=>$pagination]);
    }

    public function actionRegistroExitoso(){

        $this->layout = 'codigo';
        return $this->render('registro-exitoso');
    }

    /* public function actionRegistroExitoso(){

        $this->layout = 'codigo';
        return $this->redirect(['registro-exitoso']);
    } */

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetCity($id)
    {
        $countTypes = City::find()
            ->where(['stateId'=>$id])
            ->count();

        $type = City::find()
            ->where(['stateId'=>$id])
            ->all();

        if($countTypes > 0 ){
            echo "<option value=''>Selecciona la ciudad</option>";
            foreach ($type as $value) {
                # code...
                echo "<option value='".$value->id."'>".$value->nombre."</option>";
            }
        } else {

            echo "<option>--</option>";
        }

    }

    public function actionGetMarca($id)
    {

        $countTypes = Station::find()
            ->where(['cityId'=>$id])
            ->count();

        /*
        SELECT brand.id as id, brand.name
    FROM station INNER JOIN brand 
            ON station.brandId = brand.id
   WHERE station.cityId = 4
        */    

        $modelPoint = new Query;
        $modelPoint  ->select(['brand.id as id','brand.name as name'])  
                ->from('station')
                ->join( 'INNER JOIN', 
                    'brand',
                    'station.brandId =brand.id'
                )
                ->where(['station.cityId' => $id])
                ->groupBy('brand.name'); 

        $command = $modelPoint->createCommand();
        $data = $command->queryAll();    

        if($countTypes > 0 ){
            echo "<option value=''>Selecciona la MARCA/BANDERA </option>";

            //print_r($data);
            for ($i=0; $i < count($data); $i++) { 
                # code...
                echo "<option value='".$data[$i]['id']."'>".$data[$i]['name']."</option>";

            }
            
        } else {

            echo "<option>--</option>";
        }

    } 

    public function actionGetStation($id,$idCity)
    {
               
        $countTypes = Station::find()
            ->where(['brandId'=>$id,'cityId' => $idCity])
            ->count();

        $type = Station::find()
            ->where(['brandId'=>$id,'cityId' => $idCity])
            ->all();

        if($countTypes > 0 ){
            echo "<option value=''>Selecciona la Estación</option>";
            foreach ($type as $value) {
                # code...
                echo "<option value='".$value->id."'>".$value->name."</option>";
            }
        } else {

            echo "<option>--</option>";
        } 

    }


    public function actionGetBrand($id)
    {
        $countTypes = Station::find()
            ->where(['brandId'=>$id])
            ->count();

        $type = Station::find()
            ->where(['brandId'=>$id])
            ->all();

        if($countTypes > 0 ){
            echo "<option value=''>Selecciona la MARCA/BANDERA </option>";
            foreach ($type as $value) {
                # code...
                echo "<option value='".$value->id."'>".$value->name."</option>";
            }
        } else {

            echo "<option>--</option>";
        }

    }        


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
