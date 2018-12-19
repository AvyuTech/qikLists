<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaInboundShipmentPerformanceReportData;

/**
 * FbaInboundShipmentPerformanceReportDataSearch represents the model behind the search form about `app\models\FbaInboundShipmentPerformanceReportData`.
 */
class FbaInboundShipmentPerformanceReportDataSearch extends FbaInboundShipmentPerformanceReportData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fisprd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['issue_reported_date', 'shipment_creation_date', 'fba_shipment_id', 'fba_carton_id', 'fulfillment_center_id', 'sku', 'fnsku', 'asin', 'product_name', 'problem_type', 'problem_quantity', 'expected_quantity', 'received_quantity', 'performance_measurement_unit', 'fee_type', 'currency', 'fee_total', 'problem_level', 'alert_status', 'fisprd_date'], 'safe'],
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
        $query = FbaInboundShipmentPerformanceReportData::find();

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
            'fisprd_id' => $this->fisprd_id,
            'fisprd_date' => $this->fisprd_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'issue_reported_date', $this->issue_reported_date])
            ->andFilterWhere(['like', 'shipment_creation_date', $this->shipment_creation_date])
            ->andFilterWhere(['like', 'fba_shipment_id', $this->fba_shipment_id])
            ->andFilterWhere(['like', 'fba_carton_id', $this->fba_carton_id])
            ->andFilterWhere(['like', 'fulfillment_center_id', $this->fulfillment_center_id])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'asin', $this->asin])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'problem_type', $this->problem_type])
            ->andFilterWhere(['like', 'problem_quantity', $this->problem_quantity])
            ->andFilterWhere(['like', 'expected_quantity', $this->expected_quantity])
            ->andFilterWhere(['like', 'received_quantity', $this->received_quantity])
            ->andFilterWhere(['like', 'performance_measurement_unit', $this->performance_measurement_unit])
            ->andFilterWhere(['like', 'fee_type', $this->fee_type])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'fee_total', $this->fee_total])
            ->andFilterWhere(['like', 'problem_level', $this->problem_level])
            ->andFilterWhere(['like', 'alert_status', $this->alert_status]);

        return $dataProvider;
    }
}
