<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AllProductListing;

/**
 * AllProductListingSearch represents the model behind the search form about `app\models\AllProductListing`.
 */
class AllProductListingSearch extends AllProductListing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apl_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['sku', 'fnsku', 'asin', 'product_name', 'condition', 'your_price', 'mfn_listing_exists', 'mfn_fulfillable_quantity', 'afn_listing_exists', 'afn_warehouse_quantity', 'afn_fulfillable_quantity', 'afn_unsellable_quantity', 'afn_reserved_quantity', 'afn_total_quantity', 'per_unit_volume', 'afn_inbound_working_quantity', 'afn_inbound_shipped_quantity', 'afn_inbound_receiving_quantity', 'apl_date'], 'safe'],
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
        $query = AllProductListing::find();

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
            'apl_id' => $this->apl_id,
            'apl_date' => $this->apl_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'asin', $this->asin])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'your_price', $this->your_price])
            ->andFilterWhere(['like', 'mfn_listing_exists', $this->mfn_listing_exists])
            ->andFilterWhere(['like', 'mfn_fulfillable_quantity', $this->mfn_fulfillable_quantity])
            ->andFilterWhere(['like', 'afn_listing_exists', $this->afn_listing_exists])
            ->andFilterWhere(['like', 'afn_warehouse_quantity', $this->afn_warehouse_quantity])
            ->andFilterWhere(['like', 'afn_fulfillable_quantity', $this->afn_fulfillable_quantity])
            ->andFilterWhere(['like', 'afn_unsellable_quantity', $this->afn_unsellable_quantity])
            ->andFilterWhere(['like', 'afn_reserved_quantity', $this->afn_reserved_quantity])
            ->andFilterWhere(['like', 'afn_total_quantity', $this->afn_total_quantity])
            ->andFilterWhere(['like', 'per_unit_volume', $this->per_unit_volume])
            ->andFilterWhere(['like', 'afn_inbound_working_quantity', $this->afn_inbound_working_quantity])
            ->andFilterWhere(['like', 'afn_inbound_shipped_quantity', $this->afn_inbound_shipped_quantity])
            ->andFilterWhere(['like', 'afn_inbound_receiving_quantity', $this->afn_inbound_receiving_quantity]);

        return $dataProvider;
    }
}
