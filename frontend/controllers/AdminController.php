<?php
namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use common\models\User;
use common\models\UserSearch;
use common\models\Campaign;
use common\models\Station;
use common\models\Team;
use yii\data\ActiveDataProvider;
use yii\db\Query;


class AdminController extends Controller
{
	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'admin','home','campana','users','user-grilla'],
                'rules' => [
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'estacion','home','campana','users','user-grilla'],
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

	public function actionIndex()
    {

    	return $this->redirect(["estacion"]);

    }

    public function actionContact()
    {

        if (isset($_POST['idStation'])) {
            $idStation = $_POST['idStation'];
        } else {
            $idStation = 1;
        }
        return $this->render("contact",['idStation'=>$idStation]);

    }

    public function actionEstacion()
    {

    	$userId = Yii::$app->user->identity->id;

    	$model = new Station();
    	$modelTeam = new Query;
        $modelTeam  ->select(['station.name as name','station.id as id'])  
                ->from('station')
                ->join( 'INNER JOIN', 
                    'team',
                    'station.id = team.stationId'
                )
                ->where(['team.userId' => $userId]); 

        $command = $modelTeam->createCommand();
        $data = $command->queryAll();
	
        return $this->render('estacion', [
                'model' => $model, 'listStation'=>$data,
        ]);
        
    }

    public function actionCampana() {

    	//$this->layout = 'registro';
    	$camp = Campaign::find()->where(['activate'=>1])->one();

    	$station = new Station();
    	
    	if (Yii::$app->request->post()) {

    		//print_r(Yii::$app->request->post()); die();

    	    //station
    	    $idStation = $_POST['idStation'];
       	    $totalPoint = $station->getPointIsla($idStation);

       	    return $this->render('campana', [
                'camp'=>$camp,
                'totalPoint'=>$totalPoint,
                'idStation'=>$idStation,
        	]);

    	}

        

    }

    public function actionHome(){

        $this->layout = 'main';
        $model = new User();


        if (Yii::$app->request->post()) {

        	//print_r(Yii::$app->request->post()); die();

        	if (isset($_POST['idStation'])) {
        		$idStation = $_POST['idStation'];
        	} else if ($_POST['Station']['id']) {
        		//station
    	    	$idStation = $_POST['Station']['id'];
        	}
			
			return $this->render('home', [
            	'model' => $model, 'idStation'=>$idStation,
        	]);

    	}
        
    }

    public function actionUsers($id){

    	    //print_r(Yii::$app->request->post()); 
    	    //die();

        		$idStation = $id;
        		
        		$searchModel = new UserSearch();
        		//$searchModel->stationId = $idStation;
      			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        		//print_r($model); die(); 
   		
    			$pagination = new Pagination([
			        'defaultPageSize' => 5,
			        'totalCount' => $dataProvider->getTotalCount(),
			        'pageSize' => 5, //to set count items on one page, if not set will be set from defaultPageSize
			        'pageSizeLimit' => [1, 5], //to set range for pageSize
     			]);

        	return $this->render('users',[
    			'dataProvider'=>$dataProvider,
    			'idStation'=>$idStation,
    			'searchModel'=>$searchModel,
    			'pagination'=>$pagination,
    		]);
    	
    }

    public function actionUserGrilla(){

    	$this->layout = 'codigo';
    	$model = new User();

    	if (Yii::$app->request->post()) {
    	    //print_r(Yii::$app->request->post()); die();

    	    if (isset($_POST['idStation']) && isset($_POST['idUser'])) {
        		$idStation = $_POST['idStation']; 
        		$idUser = $_POST['idUser'];

                $infoUser = User::find()->where(['id'=>$idUser])->one();
        		$infoCity= $model->getUserCity($idStation,$idUser);
        		$result = $model->getGrillaUser($idStation,$idUser); 
                $infoPoint = $model->getPointUser($idStation,$idUser);

        		
    		
        	}

        	return $this->render('user-grilla',[
    			'model'=>$model,'idStation'=>$idStation,
    			'result'=>$result,
    			'infoCity'=>$infoCity,
                'infoUser'=>$infoUser,
                'infoPoint'=>$infoPoint,

    		]);

    	}  
    }


}