<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\Role;
use common\models\Station;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $modelImport = new \yii\base\DynamicModel([
                        'fileImport'=>'File Import',
                    ]);
        $modelImport->addRule(['fileImport'],'required');
        $modelImport->addRule(['fileImport'],'file',['extensions'=>'ods,xls,xlsx,csv'],['maxSize'=>1024*1024]);



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelImport'=> $modelImport,
        ]);
    }


    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "User #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new User model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $password = "123456";
        $request = Yii::$app->request;
        $modelStation = Station::find()->all();
        $modelRole = Role::find()->all();
        $model = new User(); 
        $model->password = $password;
        $model->passwordConfirm = $password;
        $model->setPassword($password); 
        $model->generateAuthKey(); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear un nuevo usuario",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model, 'modelRole'=>$modelRole, 'modelStation'=>$modelStation,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Crear un nuevo usuario",
                    'content'=>'<span class="text-success">Usuario creado exitosamente!</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Crear uno mas',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Crear un nuevo usuario",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model, 'modelRole'=>$modelRole,'modelStation'=>$modelStation,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model, 'modelRole'=>$modelRole, 'modelStation'=>$modelStation,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $modelRole = Role::find()->all();
        $modelStation= Station::find()->all();
        $model = $this->findModel($id); 


        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Actualizar usuario #".$model->fullname,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model, 'modelRole'=>$modelRole, 'modelStation'=>$modelStation,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Usuario #".$model->fullname,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model, 'modelRole'=>$modelRole, 'modelStation'=>$modelStation,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Actualizar usuario #".$model->fullname,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model, 'modelRole'=>$modelRole, 'modelStation'=>$modelStation,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model, 'modelRole'=>$modelRole, 'modelStation'=>$modelStation,
                ]);
            }
        }
    }

    /**
     * Delete an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    public function actionUsuarios(){
            $modelImport = new \yii\base\DynamicModel([
                        'fileImport'=>'File Import',
                    ]);

            $modelImport->addRule(['fileImport'],'required');
            $modelImport->addRule(['fileImport'],'file',['extensions'=>'ods,xls,xlsx,csv'],['maxSize'=>1024*1024]);


            if(Yii::$app->request->post()){
               
               $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport,'fileImport');
                if($modelImport->fileImport && $modelImport->validate()){
                    $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                    $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
                    $baseRow = 2;
                    $count = 0;
                    $password = "123123";

                    //print_r($sheetData); 

                   for($baseRow =2 ; $baseRow <= $highestRow; $baseRow++){
                            $model = new User();
                            $model->role = (string)$sheetData[$baseRow]['A'];
                            $model->fullname = (string)$sheetData[$baseRow]['B'];
                            $model->personalId = (int)$sheetData[$baseRow]['C'];
                            $model->email = (string)$sheetData[$baseRow]['D'];
                            $model->phone = (int)$sheetData[$baseRow]['E'];
                            $model->stationId = (int)$sheetData[$baseRow]['F'];
                            $model->password = $password;
                            $model->passwordConfirm = $password;
                            $model->setPassword($password); 
                            $model->generateAuthKey(); 

                            if( $model->save() && $model->validate()) {
                                $count++;
                            }
                    }
                    
                    Yii::$app->session->setFlash('success', 'Total usuarios creados: ' .$count);
                    
                    return $this->redirect(['index']);
                    
                }else{
                    
                    Yii::$app->session->setFlash->setFlash('error','Error');
                }

            }

            return $this->render('import',[
                    'modelImport' => $modelImport,
            ]);
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
