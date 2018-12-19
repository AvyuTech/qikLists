<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CustomizedServicesUser;

/**
 * CustomizedServicesUserSearch represents the model behind the search form about `app\models\CustomizedServicesUser`.
 */
class CustomizedServicesUserSearch extends CustomizedServicesUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['csu_id', 'csu_is_payment_done', 'created_at', 'updated_at', 'created_by', 'updated_by', 'csu_status'], 'integer'],
            [['csu_stripe_invoice_id', 'csu_first_name', 'csu_last_name', 'csu_email', 'csu_contact_no', 'csu_otp', 'csu_payment_stripe_id', 'csu_date', 'csu_services'], 'safe'],
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
        $query = CustomizedServicesUser::find();

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
            'csu_id' => $this->csu_id,
            'csu_is_payment_done' => $this->csu_is_payment_done,
            'csu_date' => $this->csu_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'csu_status' => $this->csu_status,
        ]);

        $query->andFilterWhere(['like', 'csu_first_name', $this->csu_first_name])
            ->andFilterWhere(['like', 'csu_last_name', $this->csu_last_name])
            ->andFilterWhere(['like', 'csu_services', $this->csu_services])
            ->andFilterWhere(['like', 'csu_email', $this->csu_email])
            ->andFilterWhere(['like', 'csu_contact_no', $this->csu_contact_no])
            ->andFilterWhere(['like', 'csu_otp', $this->csu_otp])
            ->andFilterWhere(['like', 'csu_payment_stripe_id', $this->csu_payment_stripe_id]);

        return $dataProvider;
    }
}
