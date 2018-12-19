<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VaNotification;

/**
 * VaNotificationSearch represents the model behind the search form about `app\models\VaNotification`.
 */
class VaNotificationSearch extends VaNotification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vn_id', 'vn_va_id', 'vn_seller_id', 'vn_shipment_refund_event_data_id', 'vn_is_seen', 'created_at', 'updated_at', 'created_by', 'updated_by', 'vn_status'], 'integer'],
            [['vn_amazon_order_id', 'vn_refund_posted_date'], 'safe'],
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
        $query = VaNotification::find();

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
            'vn_id' => $this->vn_id,
            'vn_va_id' => $this->vn_va_id,
            'vn_seller_id' => $this->vn_seller_id,
            'vn_shipment_refund_event_data_id' => $this->vn_shipment_refund_event_data_id,
            'vn_is_seen' => $this->vn_is_seen,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'vn_status' => $this->vn_status,
        ]);

        $query->andFilterWhere(['like', 'vn_amazon_order_id', $this->vn_amazon_order_id])
            ->andFilterWhere(['like', 'vn_refund_posted_date', $this->vn_refund_posted_date]);

        return $dataProvider;
    }
}
