<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaFinancialTransaction;

/**
 * FbaFinancialTransactionSearch represents the model behind the search form about `app\models\FbaFinancialTransaction`.
 */
class FbaFinancialTransactionSearch extends FbaFinancialTransaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fft_diff_days', 'fft_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['date_time', 'settlement_id', 'type', 'order_id', 'sku', 'description', 'quantity', 'marketplace', 'fulfillment', 'order_city', 'order_state', 'order_postal', 'product_sales', 'shipping_credits', 'gift_wrap_credits', 'promotional_rebates', 'sales_tax_collected', 'Marketplace_Facilitator_Tax', 'selling_fees', 'fba_fees', 'other_transaction_fees', 'other', 'total', 'fft_date'], 'safe'],
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
        $query = FbaFinancialTransaction::find();

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
            'fft_id' => $this->fft_id,
            'fft_date' => $this->fft_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'date_time', $this->date_time])
            ->andFilterWhere(['like', 'settlement_id', $this->settlement_id])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'marketplace', $this->marketplace])
            ->andFilterWhere(['like', 'fulfillment', $this->fulfillment])
            ->andFilterWhere(['like', 'order_city', $this->order_city])
            ->andFilterWhere(['like', 'order_state', $this->order_state])
            ->andFilterWhere(['like', 'order_postal', $this->order_postal])
            ->andFilterWhere(['like', 'product_sales', $this->product_sales])
            ->andFilterWhere(['like', 'shipping_credits', $this->shipping_credits])
            ->andFilterWhere(['like', 'gift_wrap_credits', $this->gift_wrap_credits])
            ->andFilterWhere(['like', 'promotional_rebates', $this->promotional_rebates])
            ->andFilterWhere(['like', 'sales_tax_collected', $this->sales_tax_collected])
            ->andFilterWhere(['like', 'Marketplace_Facilitator_Tax', $this->Marketplace_Facilitator_Tax])
            ->andFilterWhere(['like', 'selling_fees', $this->selling_fees])
            ->andFilterWhere(['like', 'fba_fees', $this->fba_fees])
            ->andFilterWhere(['like', 'other_transaction_fees', $this->other_transaction_fees])
            ->andFilterWhere(['like', 'other', $this->other])
            ->andFilterWhere(['like', 'total', $this->total]);

        return $dataProvider;
    }
}
