<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaStrandedInventoryReportData;

/**
 * FbaStrandedInventoryReportDataSearch represents the model behind the search form about `app\models\FbaStrandedInventoryReportData`.
 */
class FbaStrandedInventoryReportDataSearch extends FbaStrandedInventoryReportData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fsird_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['primary_action', 'date_stranded', 'date_classified_as_unsellable', 'status_primary', 'status_secondary', 'error_message', 'asin', 'sku', 'fnsku', 'product_name', 'condition', 'fulfilled_by', 'fulfillable_qty', 'your_price', 'unfulfillable_qty', 'reserved_quantity', 'inbound_shipped_qty', 'fsird_date'], 'safe'],
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
        $query = FbaStrandedInventoryReportData::find();

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
            'fsird_id' => $this->fsird_id,
            'fsird_date' => $this->fsird_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'primary_action', $this->primary_action])
            ->andFilterWhere(['like', 'date_stranded', $this->date_stranded])
            ->andFilterWhere(['like', 'date_classified_as_unsellable', $this->date_classified_as_unsellable])
            ->andFilterWhere(['like', 'status_primary', $this->status_primary])
            ->andFilterWhere(['like', 'status_secondary', $this->status_secondary])
            ->andFilterWhere(['like', 'error_message', $this->error_message])
            ->andFilterWhere(['like', 'asin', $this->asin])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'fulfilled_by', $this->fulfilled_by])
            ->andFilterWhere(['like', 'fulfillable_qty', $this->fulfillable_qty])
            ->andFilterWhere(['like', 'your_price', $this->your_price])
            ->andFilterWhere(['like', 'unfulfillable_qty', $this->unfulfillable_qty])
            ->andFilterWhere(['like', 'reserved_quantity', $this->reserved_quantity])
            ->andFilterWhere(['like', 'inbound_shipped_qty', $this->inbound_shipped_qty]);

        return $dataProvider;
    }
}
