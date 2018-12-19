<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DataLastFetchDatetime;

/**
 * DataLastFetchDatetimeSearch represents the model behind the search form about `app\models\DataLastFetchDatetime`.
 */
class DataLastFetchDatetimeSearch extends DataLastFetchDatetime
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dlfd_id'], 'integer'],
            [['dlfd_last_orders_time'], 'safe'],
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
        $query = DataLastFetchDatetime::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'dlfd_id' => $this->dlfd_id,
        ]);

        $query->andFilterWhere(['like', 'dlfd_last_orders_time', $this->dlfd_last_orders_time]);

        return $dataProvider;
    }
}
