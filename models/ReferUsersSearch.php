<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReferUsers;

/**
 * ReferUsersSearch represents the model behind the search form about `app\models\ReferUsers`.
 */
class ReferUsersSearch extends ReferUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ru_id', 'ru_refer_user_id', 'ru_used_promo_code', 'ru_plan', 'ru_refer_date', 'ru_refered_by', 'created_by', 'updated_by', 'created_at', 'updated_at', 'ru_status'], 'integer'],
            [['ru_payout_months_done', 'ru_payout_months', 'ru_payment_amount', 'ru_payment_status', 'ru_payout_percentage', 'ru_payment_approve_date'], 'safe'],
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
        $query = ReferUsers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['ru_id' => SORT_DESC]
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
            'ru_id' => $this->ru_id,
            'ru_refer_user_id' => $this->ru_refer_user_id,
            'ru_used_promo_code' => $this->ru_used_promo_code,
            'ru_plan' => $this->ru_plan,
            'ru_payout_months' => $this->ru_payout_months,
            'MONTH(ru_refer_date)' => $this->ru_refer_date,
            'ru_payment_status' => $this->ru_payment_status,
            'ru_refered_by' => $this->ru_refered_by,
            'ru_payout_months_done' => $this->ru_payout_months_done,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'ru_status' => $this->ru_status,
        ]);

        return $dataProvider;
    }
}
