<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderItemsAsin;

/**
 * OrderItemsAsinSearch represents the model behind the search form about `app\models\OrderItemsAsin`.
 */
class OrderItemsAsinSearch extends OrderItemsAsin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oia_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'oia_status'], 'integer'],
            [['oia_order_id', 'oia_asin', 'oia_category', 'oia_purchase_date'], 'safe'],
            [['oia_referral_fee'], 'number'],
            [['oia_item_height', 'oia_item_width', 'oia_item_length', 'oia_item_weight', 'oia_package_height', 'oia_package_width', 'oia_package_length', 'oia_package_weight'], 'number'],
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
        $query = OrderItemsAsin::find();

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
            'oia_id' => $this->oia_id,
            'oia_referral_fee' => $this->oia_referral_fee,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'oia_status' => $this->oia_status,
            'oia_item_height' => $this->oia_item_height,
            'oia_item_length' => $this->oia_item_length,
            'oia_item_width' => $this->oia_item_width,
            'oia_item_weight' => $this->oia_item_weight,
            'oia_package_height' => $this->oia_package_height,
            'oia_package_length' => $this->oia_package_length,
            'oia_package_width' => $this->oia_package_width,
            'oia_package_weight' => $this->oia_package_weight,
        ]);

        $query->andFilterWhere(['like', 'oia_order_id', $this->oia_order_id])
            ->andFilterWhere(['like', 'oia_asin', $this->oia_asin])
            ->andFilterWhere(['like', 'oia_purchase_date', $this->oia_purchase_date])
            ->andFilterWhere(['like', 'oia_category', $this->oia_category]);

        return $dataProvider;
    }
}
