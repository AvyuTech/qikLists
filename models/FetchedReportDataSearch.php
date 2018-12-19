<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FetchedReportData;

/**
 * FetchedReportDataSearch represents the model behind the search form about `app\models\FetchedReportData`.
 */
class FetchedReportDataSearch extends FetchedReportData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frd_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'frd_status'], 'integer'],
            [['frd_report_id', 'frd_report_datetime', 'frd_report_type', 'frd_date'], 'safe'],
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
        $query = FetchedReportData::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'frd_status' => $this->frd_status,
        ]);

        $query->andFilterWhere(['like', 'frd_report_id', $this->frd_report_id])
            ->andFilterWhere(['like', 'frd_report_datetime', $this->frd_report_datetime])
            ->andFilterWhere(['like', 'frd_report_type', $this->frd_report_type]);

        return $dataProvider;
    }
}
