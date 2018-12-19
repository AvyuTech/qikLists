<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Affiliates;

/**
 * AffiliatesSearch represents the model behind the search form about `app\models\Affiliates`.
 */
class AffiliatesSearch extends Affiliates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_id', 'a_user_id', 'a_usage_limit', 'created_by', 'updated_by', 'created_at', 'updated_at', 'a_status'], 'integer'],
            [['a_payout_percentage', 'a_affiliate_coupon', 'a_allocated_stripe_coupon', 'a_valid_plan'], 'safe'],
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
        $query = Affiliates::find();

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
            'a_id' => $this->a_id,
            'a_user_id' => $this->a_user_id,
            'a_usage_limit' => $this->a_usage_limit,
            'a_payout_percentage' => $this->a_payout_percentage,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'a_status' => $this->a_status,
        ]);

        $query->andFilterWhere(['like', 'a_affiliate_coupon', $this->a_affiliate_coupon])
            ->andFilterWhere(['like', 'a_allocated_stripe_coupon', $this->a_allocated_stripe_coupon])
            ->andFilterWhere(['like', 'a_valid_plan', $this->a_valid_plan]);

        return $dataProvider;
    }
}
