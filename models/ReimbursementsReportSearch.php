<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReimbursementsReport;

/**
 * ReimbursementsReportSearch represents the model behind the search form about `app\models\ReimbursementsReport`.
 */
class ReimbursementsReportSearch extends ReimbursementsReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rr_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['approval_date', 'reimbursement_id', 'case_id', 'amazon_order_id', 'reason', 'sku', 'fnsku', 'asin', 'product_name', 'condition', 'currency_unit', 'amount_per_unit', 'amount_total', 'quantity_reimbursed_cash', 'quantity_reimbursed_inventory', 'quantity_reimbursed_total', 'original_reimbursement_id', 'original_reimbursement_type'], 'safe'],
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
        $query = ReimbursementsReport::find();

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
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'approval_date', $this->approval_date])
            ->andFilterWhere(['like', 'reimbursement_id', $this->reimbursement_id])
            ->andFilterWhere(['like', 'case_id', $this->case_id])
            ->andFilterWhere(['like', 'amazon_order_id', $this->amazon_order_id])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'asin', $this->asin])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'currency_unit', $this->currency_unit])
            ->andFilterWhere(['like', 'amount_per_unit', $this->amount_per_unit])
            ->andFilterWhere(['like', 'amount_total', $this->amount_total])
            ->andFilterWhere(['like', 'quantity_reimbursed_cash', $this->quantity_reimbursed_cash])
            ->andFilterWhere(['like', 'quantity_reimbursed_inventory', $this->quantity_reimbursed_inventory])
            ->andFilterWhere(['like', 'quantity_reimbursed_total', $this->quantity_reimbursed_total])
            ->andFilterWhere(['like', 'original_reimbursement_id', $this->original_reimbursement_id])
            ->andFilterWhere(['like', 'original_reimbursement_type', $this->original_reimbursement_type]);

        return $dataProvider;
    }
}
