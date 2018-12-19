<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RepriserRule;

/**
 * RepriserRuleSearch represents the model behind the search form about `app\models\RepriserRule`.
 */
class RepriserRuleSearch extends RepriserRule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rr_id', 'rr_rule_comparison_ignore_amazon', 'rr_raise_price_comparison_ignore_amazon', 'created_at', 'updated_at', 'created_by', 'updated_by', 'rr_status'], 'integer'],
            [['rr_name', 'rr_goal', 'rr_match_action', 'rr_pricing_action', 'rr_rule_comparison', 'rr_raise_price', 'rr_raise_price_action', 'rr_raise_price_comparison'], 'safe'],
            [['rr_pricing_amount', 'rr_pricing_amount_type', 'rr_raise_price_amount', 'rr_raise_price_type', 'rr_pricing_percentage', 'rr_raise_price_percentage'], 'number'],
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
        $query = RepriserRule::find();

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
            'rr_id' => $this->rr_id,
            'rr_pricing_amount' => $this->rr_pricing_amount,
            'rr_pricing_amount_type' => $this->rr_pricing_amount_type,
            'rr_rule_comparison_ignore_amazon' => $this->rr_rule_comparison_ignore_amazon,
            'rr_raise_price_amount' => $this->rr_raise_price_amount,
            'rr_raise_price_type' => $this->rr_raise_price_type,
            'rr_raise_price_comparison_ignore_amazon' => $this->rr_raise_price_comparison_ignore_amazon,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'rr_status' => $this->rr_status,
        ]);

        $query->andFilterWhere(['like', 'rr_name', $this->rr_name])
            ->andFilterWhere(['like', 'rr_goal', $this->rr_goal])
            ->andFilterWhere(['like', 'rr_match_action', $this->rr_match_action])
            ->andFilterWhere(['like', 'rr_pricing_action', $this->rr_pricing_action])
            ->andFilterWhere(['like', 'rr_rule_comparison', $this->rr_rule_comparison])
            ->andFilterWhere(['like', 'rr_raise_price', $this->rr_raise_price])
            ->andFilterWhere(['like', 'rr_raise_price_action', $this->rr_raise_price_action])
            ->andFilterWhere(['like', 'rr_raise_price_comparison', $this->rr_raise_price_comparison]);

        return $dataProvider;
    }
}
