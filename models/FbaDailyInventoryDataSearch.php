<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaDailyInventoryData;

/**
 * FbaDailyInventoryDataSearch represents the model behind the search form of `app\models\FbaDailyInventoryData`.
 */
class FbaDailyInventoryDataSearch extends FbaDailyInventoryData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fdid_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['snapshot_date', 'fnsku', 'sku', 'product_name', 'quantity', 'fulfillment_center_id', 'detailed_disposition', 'country', 'fdid_date'], 'safe'],
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
        $query = FbaDailyInventoryData::find();

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
            'fdid_id' => $this->fdid_id,
            'fdid_date' => $this->fdid_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'snapshot_date', $this->snapshot_date])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'fulfillment_center_id', $this->fulfillment_center_id])
            ->andFilterWhere(['like', 'detailed_disposition', $this->detailed_disposition])
            ->andFilterWhere(['like', 'country', $this->country]);

        return $dataProvider;
    }
}
