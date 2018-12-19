<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdjustmentInventoryReport;

/**
 * AdjustmentInventoryReportSearch represents the model behind the search form about `app\models\AdjustmentInventoryReport`.
 */
class AdjustmentInventoryReportSearch extends AdjustmentInventoryReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['air_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['endDate', 'startDate', 'itemStatus', 'adjusted_date', 'transaction_item_id', 'fnsku', 'sku', 'product_name', 'fulfillment_center_id', 'quantity', 'reason', 'disposition'], 'safe'],
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
        $query = AdjustmentInventoryReport::find();

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
            'air_id' => $this->air_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'transaction_item_id', $this->transaction_item_id]) //->andFilterWhere(['like', 'adjusted_date', $this->adjusted_date])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'fulfillment_center_id', $this->fulfillment_center_id])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['between', 'SUBSTRING_INDEX(adjusted_date, "T", 1)', $this->startDate, $this->endDate])
            ->andFilterWhere(['like', 'disposition', $this->disposition]);

        if($itemStatus = $this->itemStatus) {
            $reimbursed = ReimbursementsReport::find()->select(['sku'])->column();

            if($itemStatus == 'yes') {
                $query->andWhere(['IN', 'sku', $reimbursed]);
            }
            if($itemStatus == 'no') {
                $query->andWhere(['NOT IN', 'sku', $reimbursed]);
            }
        }

        return $dataProvider;
    }
}
