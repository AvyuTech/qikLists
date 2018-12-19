<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NotificationSetting;

/**
 * NotificationSettingSearch represents the model behind the search form about `app\models\NotificationSetting`.
 */
class NotificationSettingSearch extends NotificationSetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ns_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'ns_status'], 'integer'],
            [['ns_email', 'ns_mobile_no'], 'safe'],
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
        $query = NotificationSetting::find();

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
            'ns_id' => $this->ns_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'ns_status' => $this->ns_status,
        ]);

        $query->andFilterWhere(['like', 'ns_email', $this->ns_email])
            ->andFilterWhere(['like', 'ns_mobile_no', $this->ns_mobile_no]);

        return $dataProvider;
    }
}
