<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Query;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $role
 * @property int $activate
 * @property int $documentId
 * @property int $phone
 * @property string $fullname
 * @property int $personalId
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Redencion[] $redencions
 * @property Register[] $registers
 * @property Team[] $teams
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const ACTIVATE = 1;


    public $password;
    public $passwordConfirm;
    public $verification_token;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['auth_key', 'password_hash', 'password_reset_token', 'email', 'status', 'role', 'activate', 'documentId', 'phone', 'fullname', 'personalId'], 'required'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['activate', 'default', 'value' => self::ACTIVATE],
            [['email', 'status', 'role', 'activate', 'phone', 'fullname', 'personalId','stationId'], 'required','message' => '{attribute} No puede ser nulo'],
            [['status', 'role', 'activate', 'documentId', 'phone', 'personalId','stationId'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['password_hash', 'password_reset_token', 'fullname','avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 100],
            [['passwordConfirm'], 'compare', 'compareAttribute' => 'password'],
            [['password','passwordConfirm'], 'required', 'message' => '{attribute} No puede ser nulo', 'when' => function($model) {
                // validate only for new records
                return $model->getIsNewRecord();
            }],
            ['password', 'string', 'min' => 6, 'max' => 72],
            ['personalId','unique','message' => 'Esta identificación ya ha sido tomada'],


        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'role' => Yii::t('app', 'Rol'),
            'activate' => Yii::t('app', 'Activate'),
            'documentId' => Yii::t('app', 'Document ID'),
            'phone' => Yii::t('app', 'Número de contacto'),
            'fullname' => Yii::t('app', 'Nombre Completo'),
            'personalId' => Yii::t('app', 'Número de Identificación'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'stationId' => Yii::t('app', 'Nombre de la Estación'),
            'password'=>Yii::t('app', 'Contraseña'),
            'passwordConfirm'=>Yii::t('app', 'Confirmar Contraseña'),
        ];
    }

    public static function isUserSuperAdmin($id)
    {


       if (User::findOne(['personalId' => $id, 'activate' => '1', 'role' => 3])){
            return true;
       } else {
            return false;
       }

    }


    public static function isUserAdmin($id)
    {
       if (User::findOne(['id' => $id, 'activate' => '1', 'role' => 2])){
            return true;
       } else {
            return false;
       }

    }

    public static function isUserSimple($id)
    {
       if (User::findOne(['id' => $id, 'activate' => '1', 'role' => 1])){
            return true;
       } else {

            return false;
       }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Role::className(), ['id' => 'role']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStation()
    {
        return $this->hasOne(Station::className(), ['id' => 'stationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRedencions()
    {
        return $this->hasMany(Redencion::className(), ['userId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisters()
    {
        return $this->hasMany(Register::className(), ['userId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['userId' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPersonalId($personalId)
    {
        return static::findOne(['personalId' => $personalId]);
    }



    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

        /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        //$user->username = $this->username;
        $user->email = $this->email;
        $user->status = 10;
        $user->role = 1;
        $user->activate = 1;
        $user->documentId = 1;
        $user->phone = $this->phone;
        $user->personalId = $this->personalId;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save();

    }



    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }


    public function getPointUser($idStation,$idUser){
        
        $total = 0;
        $modelPoint = new Query;
        $modelPoint  ->select(['sum(code.point) as total'])  
                ->from('user')
                ->join( 'INNER JOIN', 
                    'register',
                    'user.id =register.userId'
                )
                ->join( 'INNER JOIN', 
                    'code',
                    'register.codeId =code.cod'
                )
                ->where(['user.stationId' => $idStation,'user.id'=>$idUser]); 

        $command = $modelPoint->createCommand();
        $data = $command->queryAll();


        if ($data[0]['total']) {

            $total = $data[0]['total'];
        }

        return $total;


    }

    public function getUserCity($idStation,$idUser){
        
        $modelPoint = new Query;
        $modelPoint  ->select(['city.nombre as ciudad','state.name as dept'])  
                ->from('user')
                ->join( 'INNER JOIN', 
                    'station',
                    'user.stationId = station.id'
                )
                ->join( 'INNER JOIN', 
                    'city',
                    'station.cityId = city.id'
                )
                ->join( 'INNER JOIN', 
                    'state',
                    'city.stateId = state.id'
                )
                ->where(['user.stationId' => $idStation,'user.id'=>$idUser]); 

        $command = $modelPoint->createCommand();
        $data = $command->queryAll();

        $city = $data[0]['ciudad'];
        $dept = $data[0]['dept'];



        return $city.' - '.$dept;
    }

    public function getGrillaUser($idStation,$idUser){
        
        $modelPoint = new Query;
        $modelPoint  ->select(['code.cod as cod','code.point as point','register.created_at as fecha'])  
                ->from('user')
                ->join( 'INNER JOIN', 
                    'register',
                    'user.id =register.userId'
                )
                ->join( 'INNER JOIN', 
                    'code',
                    'register.codeId =code.cod'
                )
                ->where(['user.stationId' => $idStation,'user.id'=>$idUser]); 

        $command = $modelPoint->createCommand();
        $data = $command->queryAll();

        

        return $data;
    }
    
    public function uploadFileAvatar() {
        // get the uploaded file instance
        $image = UploadedFile::getInstance($this, 'avatar');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // generate random name for the file
        $this->avatar = time(). '.' . $image->extension;

        // the uploaded image instance
        return $image;
    }

    public function getUploadedFileAvatar() {
            // return a default image placeholder if your source avatar is not found
        $pic = isset($this->avatar) ? $this->avatar : 'avatar-perfil.jpg';
        $folderUser = Yii::$app->params['fileUploadUrl'].$this->id.'/avatar';
        FileHelper::createDirectory($folderUser, $mode = 0775, $recursive = true);
        return $folderUser.'/'.$pic;

    }


}
