<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaAllListingData;

/**
 * FbaAllListingDataSearch represents the model behind the search form about `app\models\FbaAllListingData`.
 */
class FbaAllListingDataSearch extends FbaAllListingData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fald_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['repricing_cost_price', 'repricing_min_price', 'repricing_max_price', 'repricing_rule_id', 'buybox_price', 'item_name', 'item_description', 'listing_id', 'seller_sku', 'price', 'quantity', 'open_date', 'image_url', 'item_is_marketplace', 'product_id_type', 'zshop_shipping_fee', 'item_note', 'item_condition', 'zshop_category1', 'zshop_browse_path', 'zshop_storefront_feature', 'asin1', 'asin2', 'asin3', 'will_ship_internationally', 'expedited_shipping', 'zshop_boldface', 'product_id', 'bid_for_featured_placement', 'add_delete', 'pending_quantity', 'fulfillment_channel', 'merchant_shipping_group', 'status', 'fald_date'], 'safe'],
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
        $query = FbaAllListingData::find()->andWhere(['status' => 'Active']);

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
            'fald_id' => $this->fald_id,
            'fald_date' => $this->fald_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'repricing_rule_id' => $this->repricing_rule_id,
            'repricing_max_price' => $this->repricing_max_price,
            'repricing_min_price' => $this->repricing_min_price,
            'repricing_cost_price' => $this->repricing_cost_price,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'item_description', $this->item_description])
            ->andFilterWhere(['like', 'listing_id', $this->listing_id])
            ->andFilterWhere(['like', 'seller_sku', $this->seller_sku])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'buybox_price', $this->buybox_price])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'open_date', $this->open_date])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'item_is_marketplace', $this->item_is_marketplace])
            ->andFilterWhere(['like', 'product_id_type', $this->product_id_type])
            ->andFilterWhere(['like', 'zshop_shipping_fee', $this->zshop_shipping_fee])
            ->andFilterWhere(['like', 'item_note', $this->item_note])
            ->andFilterWhere(['like', 'item_condition', $this->item_condition])
            ->andFilterWhere(['like', 'zshop_category1', $this->zshop_category1])
            ->andFilterWhere(['like', 'zshop_browse_path', $this->zshop_browse_path])
            ->andFilterWhere(['like', 'zshop_storefront_feature', $this->zshop_storefront_feature])
            ->andFilterWhere(['like', 'asin1', $this->asin1])
            ->andFilterWhere(['like', 'asin2', $this->asin2])
            ->andFilterWhere(['like', 'asin3', $this->asin3])
            ->andFilterWhere(['like', 'will_ship_internationally', $this->will_ship_internationally])
            ->andFilterWhere(['like', 'expedited_shipping', $this->expedited_shipping])
            ->andFilterWhere(['like', 'zshop_boldface', $this->zshop_boldface])
            ->andFilterWhere(['like', 'product_id', $this->product_id])
            ->andFilterWhere(['like', 'bid_for_featured_placement', $this->bid_for_featured_placement])
            ->andFilterWhere(['like', 'add_delete', $this->add_delete])
            ->andFilterWhere(['like', 'pending_quantity', $this->pending_quantity])
            ->andFilterWhere(['like', 'fulfillment_channel', $this->fulfillment_channel])
            ->andFilterWhere(['like', 'merchant_shipping_group', $this->merchant_shipping_group])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
