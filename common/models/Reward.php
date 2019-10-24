<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reward".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property int $puntos
 *
 * @property Redencion[] $redencions
 */
class Reward extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reward';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['puntos'], 'required'],
            [['puntos'], 'integer'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'puntos' => Yii::t('app', 'Puntos'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRedencions()
    {
        return $this->hasMany(Redencion::className(), ['rewardId' => 'id']);
    }
}
