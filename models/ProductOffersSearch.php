<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductOffers;

/**
 * ProductOffersSearch represents the model behind the search form about `app\models\ProductOffers`.
 */
class ProductOffersSearch extends ProductOffers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['po_id', 'po_seller_feedback_count', 'po_is_amazon_fulfillment', 'po_is_buybox_winner', 'po_is_featured_merchant', 'created_at', 'updated_at', 'created_by', 'updated_by', 'po_status'], 'integer'],
            [['po_condition'], 'safe'],
            [['po_seller_feedback_rating', 'po_listing_price', 'po_shipping_cost'], 'number'],
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
        $query = ProductOffers::find();

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
            'po_id' => $this->po_id,
            'po_seller_feedback_rating' => $this->po_seller_feedback_rating,
            'po_seller_feedback_count' => $this->po_seller_feedback_count,
            'po_listing_price' => $this->po_listing_price,
            'po_shipping_cost' => $this->po_shipping_cost,
            'po_is_amazon_fulfillment' => $this->po_is_amazon_fulfillment,
            'po_is_buybox_winner' => $this->po_is_buybox_winner,
            'po_is_featured_merchant' => $this->po_is_featured_merchant,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'po_status' => $this->po_status,
        ]);

        $query->andFilterWhere(['like', 'po_condition', $this->po_condition]);

        return $dataProvider;
    }
}
