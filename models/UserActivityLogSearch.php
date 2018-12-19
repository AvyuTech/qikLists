<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserActivityLog;

/**
 * UserActivityLogSearch represents the model behind the search form about `app\models\UserActivityLog`.
 */
class UserActivityLogSearch extends UserActivityLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ual_is_logged', 'ual_id', 'ual_user_id', 'ual_time_spent', 'created_at', 'updated_at'], 'safe'],
            [['ual_user_ip', 'ual_request_url', 'ual_message', 'ual_logout_at', 'ual_login_at', 'start_date', 'end_date'], 'safe'],
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
        $query = UserActivityLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['ual_id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ual_id' => $this->ual_id,
            'ual_user_id' => $this->ual_user_id,
           // 'ual_time_spent' => $this->ual_time_spent,
           // 'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'ual_user_ip', $this->ual_user_ip])
            ->andFilterWhere(['like', 'ual_request_url', $this->ual_request_url])
            //->andFilterWhere(['like', 'user.u_name', $this->ual_user_id])
            ->andFilterWhere(['like', 'ual_message', $this->ual_message])
            ->andFilterWhere(['between', 'DATE_FORMAT(FROM_UNIXTIME(`ual_login_at`), \'%Y-%m-%d %H:%i:%s\')', $this->start_date, $this->end_date]);

        return $dataProvider;
    }
}
