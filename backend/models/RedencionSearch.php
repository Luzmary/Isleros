<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Redencion;

/**
 * RedencionSearch represents the model behind the search form about `common\models\Redencion`.
 */
class RedencionSearch extends Redencion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rewardId', 'userId','status'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Redencion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'rewardId' => $this->rewardId,
            'userId' => $this->userId,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
