<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "redencion".
 *
 * @property int $id
 * @property string $date
 * @property int $rewardId
 * @property int $userId
 *
 * @property Reward $reward
 * @property User $user
 */
class Redencion extends \yii\db\ActiveRecord
{    
    const STATUS = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'redencion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS],
            [['date'], 'safe'],
            [['rewardId', 'userId','status'], 'required'],
            [['rewardId', 'userId'], 'integer'],
            [['rewardId'], 'exist', 'skipOnError' => true, 'targetClass' => Reward::className(), 'targetAttribute' => ['rewardId' => 'id']],
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
            'date' => Yii::t('app', 'Fecha'),
            'rewardId' => Yii::t('app', 'Premios'),
            'userId' => Yii::t('app', 'Nombre de Usuario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReward()
    {
        return $this->hasOne(Reward::className(), ['id' => 'rewardId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getEnabled()
    {
        return $this->status == 1  ? 'Redimido' : 'No Redimido';
    }
}
