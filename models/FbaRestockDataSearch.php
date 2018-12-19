<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaRestockData;

/**
 * FbaRestockDataSearch represents the model behind the search form about `app\models\FbaRestockData`.
 */
class FbaRestockDataSearch extends FbaRestockData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['Product_Description', 'SKU', 'ASIN', 'Condition', 'Supplier', 'Price', 'Sales_last_30_days_sales', 'Sales_last_30_days_units', 'Total_Inventory', 'Inbound_Inventory', 'Available_Inventory', 'Reserved_FC_transfer', 'Reserved_FC_processing', 'Reserved_Customer_Order', 'Unfulfillable', 'Fulfilled_by', 'Days_of_Supply', 'Instock_Alert', 'Recommended_Order_Quantity', 'Recommended_Order_Date', 'frd_date'], 'safe'],
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
        $query = FbaRestockData::find();

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
            'frd_id' => $this->frd_id,
            'frd_date' => $this->frd_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'Product_Description', $this->Product_Description])
            ->andFilterWhere(['like', 'SKU', $this->SKU])
            ->andFilterWhere(['like', 'ASIN', $this->ASIN])
            ->andFilterWhere(['like', 'Condition', $this->Condition])
            ->andFilterWhere(['like', 'Supplier', $this->Supplier])
            ->andFilterWhere(['like', 'Price', $this->Price])
            ->andFilterWhere(['like', 'Sales_last_30_days_sales', $this->Sales_last_30_days_sales])
            ->andFilterWhere(['like', 'Sales_last_30_days_units', $this->Sales_last_30_days_units])
            ->andFilterWhere(['like', 'Total_Inventory', $this->Total_Inventory])
            ->andFilterWhere(['like', 'Inbound_Inventory', $this->Inbound_Inventory])
            ->andFilterWhere(['like', 'Available_Inventory', $this->Available_Inventory])
            ->andFilterWhere(['like', 'Reserved_FC_transfer', $this->Reserved_FC_transfer])
            ->andFilterWhere(['like', 'Reserved_FC_processing', $this->Reserved_FC_processing])
            ->andFilterWhere(['like', 'Reserved_Customer_Order', $this->Reserved_Customer_Order])
            ->andFilterWhere(['like', 'Unfulfillable', $this->Unfulfillable])
            ->andFilterWhere(['like', 'Fulfilled_by', $this->Fulfilled_by])
            ->andFilterWhere(['like', 'Days_of_Supply', $this->Days_of_Supply])
            ->andFilterWhere(['like', 'Instock_Alert', $this->Instock_Alert])
            ->andFilterWhere(['like', 'Recommended_Order_Quantity', $this->Recommended_Order_Quantity])
            ->andFilterWhere(['like', 'Recommended_Order_Date', $this->Recommended_Order_Date]);

        return $dataProvider;
    }
}
