<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property int $id
 * @property string $name
 * @property int $activate
 * @property string $start_date 	 
 * @property string $end_date
 * @property string $created_at
 *
 * @property Code[] $codes
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campaign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'activate', 'start_date', 'end_date'], 'required'],
            [['activate'], 'integer'],
            [['start_date', 'end_date', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
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
            'activate' => Yii::t('app', 'Activate'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodes()
    {
        return $this->hasMany(Code::className(), ['campaignId' => 'id']);
    }
}
