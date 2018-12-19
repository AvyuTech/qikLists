<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AppliedRepriserRule;

/**
 * AppliedRepriserRuleSearch represents the model behind the search form about `app\models\AppliedRepriserRule`.
 */
class AppliedRepriserRuleSearch extends AppliedRepriserRule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['arr_id', 'arr_rule_id', 'arr_user_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'arr_status'], 'integer'],
            [['arr_repriser_price', 'arr_min_price', 'arr_max_price', 'arr_own_buy_box_price'], 'number'],
            [['arr_sku', 'arr_user_email', 'arr_date'], 'safe'],
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
        $query = AppliedRepriserRule::find();

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
            'arr_id' => $this->arr_id,
            'arr_rule_id' => $this->arr_rule_id,
            'arr_repriser_price' => $this->arr_repriser_price,
            'arr_min_price' => $this->arr_min_price,
            'arr_max_price' => $this->arr_max_price,
            'arr_own_buy_box_price' => $this->arr_own_buy_box_price,
            'arr_user_id' => $this->arr_user_id,
            'arr_date' => $this->arr_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'arr_status' => $this->arr_status,
        ]);

        $query->andFilterWhere(['like', 'arr_sku', $this->arr_sku])
            ->andFilterWhere(['like', 'arr_user_email', $this->arr_user_email]);

        return $dataProvider;
    }
}
