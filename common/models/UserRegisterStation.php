<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userRegisterStation".
 *
 * @property int $register_id
 * @property int $station_id
 *
 * @property Register $register
 * @property Station $station
 */
class UserRegisterStation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userRegisterStation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['register_id', 'station_id'], 'required'],
            [['register_id', 'station_id'], 'integer'],
            [['register_id', 'station_id'], 'unique', 'targetAttribute' => ['register_id', 'station_id']],
            [['register_id'], 'exist', 'skipOnError' => true, 'targetClass' => Register::className(), 'targetAttribute' => ['register_id' => 'id']],
            [['station_id'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['station_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'register_id' => Yii::t('app', 'Register ID'),
            'station_id' => Yii::t('app', 'Station ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegister()
    {
        return $this->hasOne(Register::className(), ['id' => 'register_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStation()
    {
        return $this->hasOne(Station::className(), ['id' => 'station_id']);
    }
}
