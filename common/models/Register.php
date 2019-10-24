<?php

namespace common\models;

use Yii;
use yii\db\Query;


/**
 * This is the model class for table "register".
 *
 * @property int $id
 * @property string $created_at
 * @property int $userId
 * @property int $codeId
 *
 * @property Code $code
 * @property User $user
 */
class Register extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'register';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['codeId'], 'required','message' => '{attribute} No puede ser nulo'],
            [['userId'], 'required'],
            [['codeId'], 'string'],
            [['point'], 'integer'],
            [['codeId'],'unique','message' => 'Código {value} ya fue usado'],
            [['codeId'], 'exist', 'skipOnError' => true, 'targetClass' => Code::className(), 'targetAttribute' => ['codeId' => 'cod'],'message' => 'Código {value} inválido'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Fecha de Creación'),
            'userId' => Yii::t('app', 'Usuario'),
            'codeId' => Yii::t('app', 'Código'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCode()
    {
        return $this->hasOne(Code::className(), ['cod' => 'codeId']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getSumCode(){

        $userId = Yii::$app->user->identity->id;
        $sumCode = 0;
        $restRend= 0;

        $modelRegister = new Query;
        $modelRegister  ->select(['sum(point) as total'])  
                ->from('register')
                ->where(['userId' => $userId]); 

        $command = $modelRegister->createCommand();
        $data = $command->queryAll();

        $sumCode = $data[0]['total'];

        $modelRedenciones = new Query;
        $modelRedenciones  ->select(['sum(reward.puntos) as total'])  
                ->from('redencion')
                ->join( 'INNER JOIN', 
                    'reward',
                    'reward.id =redencion.rewardId'
                )
                ->where(['userId' => $userId]); 

        $command = $modelRedenciones->createCommand();
        $data = $command->queryAll();

        $restRend = $data[0]['total'];



       // print_r($sumCode); die();


        $result = $sumCode - $restRend;

        return $result;

    }
}
