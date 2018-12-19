<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaInventoryDetailsReportData;

/**
 * FbaInventoryDetailsReportDataSearch represents the model behind the search form about `app\models\FbaInventoryDetailsReportData`.
 */
class FbaInventoryDetailsReportDataSearch extends FbaInventoryDetailsReportData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fidrd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['snapshot_date', 'transaction_type', 'fnsku', 'sku', 'product_name', 'fulfillment_center_id', 'quantity', 'disposition', 'fidrd_date'], 'safe'],
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
        $query = FbaInventoryDetailsReportData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'fidrd_id' => SORT_DESC,
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
            'fidrd_id' => $this->fidrd_id,
            'fidrd_date' => $this->fidrd_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'snapshot_date', $this->snapshot_date])
            ->andFilterWhere(['like', 'transaction_type', $this->transaction_type])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'fulfillment_center_id', $this->fulfillment_center_id])
            //->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'disposition', $this->disposition]);

        return $dataProvider;
    }
}
