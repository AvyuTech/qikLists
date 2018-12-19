<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CategoryCommission;

/**
 * CategoryCommissionSearch represents the model behind the search form about `app\models\CategoryCommission`.
 */
class CategoryCommissionSearch extends CategoryCommission
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cc_id', 'cc_seller_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'cc_status'], 'integer'],
            [['cc_name'], 'safe'],
            [['cc_commission'], 'number'],
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
        $query = CategoryCommission::find();

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
            'cc_id' => $this->cc_id,
            'cc_commission' => $this->cc_commission,
            'cc_seller_id' => $this->cc_seller_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'cc_status' => $this->cc_status,
        ]);

        $query->andFilterWhere(['like', 'cc_name', $this->cc_name]);

        return $dataProvider;
    }
}
