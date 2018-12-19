<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaRemovalOrderDetailReportData;

/**
 * FbaRemovalOrderDetailReportDataSearch represents the model behind the search form about `app\models\FbaRemovalOrderDetailReportData`.
 */
class FbaRemovalOrderDetailReportDataSearch extends FbaRemovalOrderDetailReportData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frodrd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['request_date', 'order_id', 'order_type', 'order_status', 'last_updated_date', 'sku', 'fnsku', 'disposition', 'requested_quantity', 'cancelled_quantity', 'disposed_quantity', 'shipped_quantity', 'in_process_quantity', 'removal_fee', 'currency', 'frodrd_date'], 'safe'],
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
        $query = FbaRemovalOrderDetailReportData::find();

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
            'frodrd_id' => $this->frodrd_id,
            'frodrd_date' => $this->frodrd_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'request_date', $this->request_date])
            ->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'order_type', $this->order_type])
            ->andFilterWhere(['like', 'order_status', $this->order_status])
            ->andFilterWhere(['like', 'last_updated_date', $this->last_updated_date])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'disposition', $this->disposition])
            ->andFilterWhere(['like', 'requested_quantity', $this->requested_quantity])
            ->andFilterWhere(['like', 'cancelled_quantity', $this->cancelled_quantity])
            ->andFilterWhere(['like', 'disposed_quantity', $this->disposed_quantity])
            ->andFilterWhere(['like', 'shipped_quantity', $this->shipped_quantity])
            ->andFilterWhere(['like', 'in_process_quantity', $this->in_process_quantity])
            ->andFilterWhere(['like', 'removal_fee', $this->removal_fee])
            ->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
