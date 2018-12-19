<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AllOrdesList;

/**
 * AllOrdesListSearch represents the model behind the search form about `app\models\AllOrdesList`.
 */
class AllOrdesListSearch extends AllOrdesList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aol_id', 'aol_purchase_date', 'aol_shipped_items', 'aol_unshipped_items', 'created_at', 'updated_at', 'aol_status'], 'integer'],
            [['aol_amazon_order_id', 'aol_seller_order_id', 'aol_last_updated_date', 'aol_order_status', 'aol_fulfilment_channel', 'aol_sales_channel', 'aol_ship_service'], 'safe'],
            [['aol_order_total'], 'number'],
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
        $query = AllOrdesList::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'aol_id' => SORT_DESC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'aol_id' => $this->aol_id,
            'aol_purchase_date' => $this->aol_purchase_date,
            'aol_order_total' => $this->aol_order_total,
            'aol_shipped_items' => $this->aol_shipped_items,
            'aol_unshipped_items' => $this->aol_unshipped_items,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'aol_status' => $this->aol_status,
        ]);

        $query->andFilterWhere(['like', 'aol_amazon_order_id', $this->aol_amazon_order_id])
            ->andFilterWhere(['like', 'aol_seller_order_id', $this->aol_seller_order_id])
            ->andFilterWhere(['like', 'aol_last_updated_date', $this->aol_last_updated_date])
            ->andFilterWhere(['like', 'aol_order_status', $this->aol_order_status])
            ->andFilterWhere(['like', 'aol_fulfilment_channel', $this->aol_fulfilment_channel])
            ->andFilterWhere(['like', 'aol_sales_channel', $this->aol_sales_channel])
            ->andFilterWhere(['like', 'aol_ship_service', $this->aol_ship_service]);

        return $dataProvider;
    }
}
