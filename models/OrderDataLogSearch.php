<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderDataLog;

/**
 * OrderDataLogSearch represents the model behind the search form about `app\models\OrderDataLog`.
 */
class OrderDataLogSearch extends OrderDataLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odl_id', 'odl_user_id', 'odl_shipment_data', 'odl_refund_data', 'odl_service_fee_data', 'odl_adjustment_data', 'odl_shipped_order_data', 'odl_all_asin_data', 'created_at', 'updated_at', 'created_by', 'updated_by', 'odl_status'], 'integer'],
            [['odl_order_id'], 'safe'],
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
        $query = OrderDataLog::find();

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
            'odl_id' => $this->odl_id,
            'odl_user_id' => $this->odl_user_id,
            'odl_shipment_data' => $this->odl_shipment_data,
            'odl_refund_data' => $this->odl_refund_data,
            'odl_service_fee_data' => $this->odl_service_fee_data,
            'odl_adjustment_data' => $this->odl_adjustment_data,
            'odl_shipped_order_data' => $this->odl_shipped_order_data,
            'odl_all_asin_data' => $this->odl_all_asin_data,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'odl_status' => $this->odl_status,
        ]);

        $query->andFilterWhere(['like', 'odl_order_id', $this->odl_order_id]);

        return $dataProvider;
    }
}
