<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceFeeData;

/**
 * ServiceFeeDataSearch represents the model behind the search form about `app\models\ServiceFeeData`.
 */
class ServiceFeeDataSearch extends ServiceFeeData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sfd_id', 'sfd_shipment_refund_event_data_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'sfd_status'], 'integer'],
            [['sfd_amazon_order_id', 'sfd_seller_order_id', 'sfd_fee_reason', 'sfd_fee_type', 'sfd_currency', 'sfd_seller_sku', 'sfd_fnsku', 'sfd_fee_description', 'sfd_asin'], 'safe'],
            [['sfd_fee_amount'], 'number'],
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
        $query = ServiceFeeData::find();

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
            'sfd_id' => $this->sfd_id,
            'sfd_fee_amount' => $this->sfd_fee_amount,
            'sfd_shipment_refund_event_data_id' => $this->sfd_shipment_refund_event_data_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'sfd_status' => $this->sfd_status,
        ]);

        $query->andFilterWhere(['like', 'sfd_amazon_order_id', $this->sfd_amazon_order_id])
            ->andFilterWhere(['like', 'sfd_seller_order_id', $this->sfd_seller_order_id])
            ->andFilterWhere(['like', 'sfd_fee_reason', $this->sfd_fee_reason])
            ->andFilterWhere(['like', 'sfd_fee_type', $this->sfd_fee_type])
            ->andFilterWhere(['like', 'sfd_currency', $this->sfd_currency])
            ->andFilterWhere(['like', 'sfd_seller_sku', $this->sfd_seller_sku])
            ->andFilterWhere(['like', 'sfd_fnsku', $this->sfd_fnsku])
            ->andFilterWhere(['like', 'sfd_fee_description', $this->sfd_fee_description])
            ->andFilterWhere(['like', 'sfd_asin', $this->sfd_asin]);

        return $dataProvider;
    }
}
