<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserFetchedReportDataStatus;

/**
 * UserFetchedReportDataStatusSearch represents the model behind the search form about `app\models\UserFetchedReportDataStatus`.
 */
class UserFetchedReportDataStatusSearch extends UserFetchedReportDataStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ufrds_id', 'ufrds_reimbursement_report', 'ufrds_return_report', 'ufrds_inventory_adjustment_report', 'ufrds_all_listing_report', 'ufrds_received_inventory_report', 'ufrds_restock_report', 'ufrds_all_order_report', 'created_by', 'updated_by', 'created_at', 'updated_at', 'ufrds_user_id', 'ufrds_status'], 'integer'],
            [['ufrds_date'], 'safe'],
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
        $query = UserFetchedReportDataStatus::find();

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
            'ufrds_id' => $this->ufrds_id,
            'ufrds_reimbursement_report' => $this->ufrds_reimbursement_report,
            'ufrds_return_report' => $this->ufrds_return_report,
            'ufrds_inventory_adjustment_report' => $this->ufrds_inventory_adjustment_report,
            'ufrds_all_listing_report' => $this->ufrds_all_listing_report,
            'ufrds_received_inventory_report' => $this->ufrds_received_inventory_report,
            'ufrds_restock_report' => $this->ufrds_restock_report,
            'ufrds_all_order_report' => $this->ufrds_all_order_report,
            'ufrds_date' => $this->ufrds_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'ufrds_user_id' => $this->ufrds_user_id,
            'ufrds_status' => $this->ufrds_status,
        ]);

        return $dataProvider;
    }
}
