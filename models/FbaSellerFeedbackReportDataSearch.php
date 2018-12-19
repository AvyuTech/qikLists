<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaSellerFeedbackReportData;

/**
 * FbaSellerFeedbackReportDataSearch represents the model behind the search form about `app\models\FbaSellerFeedbackReportData`.
 */
class FbaSellerFeedbackReportDataSearch extends FbaSellerFeedbackReportData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fsfrd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['Date', 'Rating', 'Comments', 'Your_Response', 'Arrived_on_Time', 'Item_as_Described', 'Customer_Service', 'Order_ID', 'Rater_Email', 'fsfrd_date'], 'safe'],
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
        $query = FbaSellerFeedbackReportData::find();

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
            'fsfrd_id' => $this->fsfrd_id,
            'fsfrd_date' => $this->fsfrd_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'Date', $this->Date])
            ->andFilterWhere(['like', 'Rating', $this->Rating])
            ->andFilterWhere(['like', 'Comments', $this->Comments])
            ->andFilterWhere(['like', 'Your_Response', $this->Your_Response])
            ->andFilterWhere(['like', 'Arrived_on_Time', $this->Arrived_on_Time])
            ->andFilterWhere(['like', 'Item_as_Described', $this->Item_as_Described])
            ->andFilterWhere(['like', 'Customer_Service', $this->Customer_Service])
            ->andFilterWhere(['like', 'Order_ID', $this->Order_ID])
            ->andFilterWhere(['like', 'Rater_Email', $this->Rater_Email]);

        return $dataProvider;
    }
}
