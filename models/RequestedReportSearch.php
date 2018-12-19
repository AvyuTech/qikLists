<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RequestedReport;

/**
 * RequestedReportSearch represents the model behind the search form about `app\models\RequestedReport`.
 */
class RequestedReportSearch extends RequestedReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rr_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'rr_status'], 'integer'],
            [['rr_report_request_id', 'rr_report_type', 'rr_start_date', 'rr_end_date', 'rr_scheduled', 'rr_submitted_date', 'rr_report_processing_status', 'rr_report_current_status'], 'safe'],
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
        $query = RequestedReport::find();

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
            'rr_id' => $this->rr_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'rr_status' => $this->rr_status,
        ]);

        $query->andFilterWhere(['like', 'rr_report_request_id', $this->rr_report_request_id])
            ->andFilterWhere(['like', 'rr_report_type', $this->rr_report_type])
            ->andFilterWhere(['like', 'rr_start_date', $this->rr_start_date])
            ->andFilterWhere(['like', 'rr_end_date', $this->rr_end_date])
            ->andFilterWhere(['like', 'rr_scheduled', $this->rr_scheduled])
            ->andFilterWhere(['like', 'rr_submitted_date', $this->rr_submitted_date])
            ->andFilterWhere(['like', 'rr_report_processing_status', $this->rr_report_processing_status])
            ->andFilterWhere(['like', 'rr_report_current_status', $this->rr_report_current_status]);

        return $dataProvider;
    }
}
