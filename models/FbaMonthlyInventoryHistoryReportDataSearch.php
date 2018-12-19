<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaMonthlyInventoryHistoryReportData;

/**
 * FbaMonthlyInventoryHistoryReportDataSearch represents the model behind the search form about `app\models\FbaMonthlyInventoryHistoryReportData`.
 */
class FbaMonthlyInventoryHistoryReportDataSearch extends FbaMonthlyInventoryHistoryReportData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fmihrd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['month', 'fnsku', 'sku', 'product_name', 'average_quantity', 'end_quantity', 'fulfillment_center_id', 'detailed_disposition', 'country', 'fmihrd_date'], 'safe'],
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
        $query = FbaMonthlyInventoryHistoryReportData::find();

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
            'fmihrd_id' => $this->fmihrd_id,
            'fmihrd_date' => $this->fmihrd_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'average_quantity', $this->average_quantity])
            ->andFilterWhere(['like', 'end_quantity', $this->end_quantity])
            ->andFilterWhere(['like', 'fulfillment_center_id', $this->fulfillment_center_id])
            ->andFilterWhere(['like', 'detailed_disposition', $this->detailed_disposition])
            ->andFilterWhere(['like', 'country', $this->country]);

        return $dataProvider;
    }
}
