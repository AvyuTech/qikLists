<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaCustomerReturnData;

/**
 * FbaCustomerReturnDataSearch represents the model behind the search form about `app\models\FbaCustomerReturnData`.
 */
class FbaCustomerReturnDataSearch extends FbaCustomerReturnData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fcrd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['return_date', 'order_id', 'sku', 'asin', 'fnsku', 'product_name', 'quantity', 'fulfillment_center_id', 'detailed_disposition', 'reason', 'status', 'license_plate_number', 'customer_comments', 'fcrd_date'], 'safe'],
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
        $query = FbaCustomerReturnData::find();

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
            'fcrd_id' => $this->fcrd_id,
            'fcrd_date' => $this->fcrd_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'return_date', $this->return_date])
            ->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'asin', $this->asin])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'fulfillment_center_id', $this->fulfillment_center_id])
            ->andFilterWhere(['like', 'detailed_disposition', $this->detailed_disposition])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'license_plate_number', $this->license_plate_number])
            ->andFilterWhere(['like', 'customer_comments', $this->customer_comments]);

        return $dataProvider;
    }
}
