<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "code".
 *
 * @property int $id
 * @property string $cod
 * @property int $campaignId
 * @property int $point
 * @property string $created_at
 *
 * @property Campaign $campaign
 * @property Register[] $registers
 * @property Reward[] $rewards
 */
class Code extends \yii\db\ActiveRecord
{
    const STATUS = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS],
            [['cod', 'campaignId', 'point','status'], 'required','message' => '{attribute} No puede ser nulo'],
            [['campaignId', 'point'], 'integer'],
            [['created_at'], 'safe'],
            [['cod'], 'string', 'max' => 45],
            [['cod'], 'unique','message' => 'Código {value} ya existe'],
            [['campaignId'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['campaignId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cod' => Yii::t('app', 'Código'),
            'campaignId' => Yii::t('app', 'Nombre de Campaña'),
            'point' => Yii::t('app', 'Puntos'),
            'created_at' => Yii::t('app', 'Fecha de Creación'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'campaignId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisters()
    {
        return $this->hasMany(Register::className(), ['codeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRewards()
    {
        return $this->hasMany(Reward::className(), ['codeId' => 'id']);
    }

    public function getEnabled()
    {
        return $this->status == 1  ? 'Usado' : 'No usado';
    }

}
