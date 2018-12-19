<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ShipmentRefundEventData;

/**
 * ShipmentRefundEventDataSearch represents the model behind the search form about `app\models\ShipmentRefundEventData`.
 */
class ShipmentRefundEventDataSearch extends ShipmentRefundEventData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sred_day_diff', 'sred_id', 'sred_quantity_shipped', 'created_at', 'updated_at', 'created_by', 'updated_by', 'sred_status'], 'integer'],
            [['startDate', 'endDate', 'itemStatus', 'sred_amazon_order_id', 'sred_seller_order_id', 'sred_marketplace_name', 'sred_shipment_posted_date', 'sred_refund_posted_date', 'sred_seller_sku', 'sred_order_item_id', 'sred_order_adjustment_item_id'], 'safe'],
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
        $query = ShipmentRefundEventData::find()->groupBy(['sred_amazon_order_id']); //->joinWith(['orderCharges'])

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
            'sred_id' => $this->sred_id,
            'sred_quantity_shipped' => $this->sred_quantity_shipped,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'sred_status' => $this->sred_status,
        ]);

        $query->andFilterWhere(['like', 'sred_amazon_order_id', $this->sred_amazon_order_id])
            ->andFilterWhere(['like', 'sred_seller_order_id', $this->sred_seller_order_id])
            ->andFilterWhere(['like', 'sred_marketplace_name', $this->sred_marketplace_name])
            ->andFilterWhere(['like', 'sred_shipment_posted_date', $this->sred_shipment_posted_date])
            ->andFilterWhere(['like', 'sred_refund_posted_date', $this->sred_refund_posted_date])
            ->andFilterWhere(['like', 'sred_seller_sku', $this->sred_seller_sku])
            ->andFilterWhere(['like', 'sred_order_item_id', $this->sred_order_item_id])
            ->andFilterWhere(['between', 'SUBSTRING_INDEX(sred_shipment_posted_date, "T", 1)', $this->startDate, $this->endDate])
            ->andFilterWhere(['like', 'sred_order_adjustment_item_id', $this->sred_order_adjustment_item_id]);

        if($itemStatus = $this->itemStatus) {
            $reimbursed = ReimbursementsReport::find()->select(['amazon_order_id'])->column();
            //$restockData = \app\models\FbaRestockData::find()->select(['SKU'])->column();
            $returnData = \app\models\FbaCustomerReturnData::find()->select(['order_id'])->column();
            //$sellerSku = ($this->orderCharges && $this->orderCharges->icld_seller_sku) ? $this->orderCharges->icld_seller_sku : null;

            if($itemStatus == 'yes') {
                $query->andWhere(['OR', ['IN', 'sred_amazon_order_id', $reimbursed], ['IN', 'sred_amazon_order_id', $returnData]]); //['IN', 'item_charge_list_data.icld_seller_sku', $restockData]
                    //->andWhere(['IN', 'sred_amazon_order_id', $returnData])
                    //->andWhere(['IN', 'item_charge_list_data.icld_seller_sku', $restockData]);
            }
            if($itemStatus == 'no') {
                $query->andWhere(['NOT IN', 'sred_amazon_order_id', $reimbursed])
                    /*->andWhere(['NOT IN', 'item_charge_list_data.icld_seller_sku', $restockData])*/
                    ->andWhere(['NOT IN', 'sred_amazon_order_id', $returnData]);
            }
        }

        return $dataProvider;
    }
}
