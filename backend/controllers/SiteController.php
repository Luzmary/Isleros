<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            if (User::isUserSuperAdmin(Yii::$app->user->identity->id))
            {
                return $this->goHome();
            }
            
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {

            $personalId = Yii::$app->request->post()['LoginForm']['personalId'];

            if (User::isUserSuperAdmin($personalId))
            {
              if($model->login() ){
                Yii::$app->session->setFlash('succes', 'Bienvenido!!');

                return $this->redirect(["index"]);
              }
            } else {

              Yii::$app->session->setFlash('error', 'Debes ser un usuario super admin, contacta con tu administrador');

               return $this->render('login', [
                    'model' => $model,
               ]); 
            } 
   
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }


        
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
