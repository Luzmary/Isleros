<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "station".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property int $cityId
 * @property int $brandId
 * @property string $created_at
 *
 * @property Brand $brand
 * @property City $city
 * @property Team[] $teams
 */
class Station extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'station';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cityId', 'brandId'], 'required'],
            [['cityId', 'brandId'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'phone'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 200],
            [['brandId'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brandId' => 'id']],
            [['cityId'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cityId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Nombre'),
            'address' => Yii::t('app', 'Dirección'),
            'phone' => Yii::t('app', 'Teléfono'),
            'cityId' => Yii::t('app', 'Ciudad'),
            'brandId' => Yii::t('app', 'Marca'),
            'created_at' => Yii::t('app', 'Fecha de Creación'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brandId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['stationId' => 'id']);
    }

    public function getPointIsla($idStation){

        $userId = Yii::$app->user->identity->id;
        
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
                ->where(['user.stationId' => $idStation]); 

        $command = $modelPoint->createCommand();
        $data = $command->queryAll();

        $total = $data[0]['total'];

        return $total;
    }

    /* SELECT  SUM(code.point)
    FROM user INNER JOIN register 
            ON user.id = register.userId
         INNER JOIN code 
            ON register.codeId = code.cod
   WHERE user.stationId = 1 */


}
