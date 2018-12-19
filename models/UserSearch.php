<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'u_type', 'created_at', 'updated_at', 'created_by', 'updated_by', 'u_status'], 'integer'],
            [['u_store_name', 'u_name', 'u_email', 'u_password', 'u_contact_no', 'u_photo', 'u_address', 'password_reset_token', 'auth_key'], 'safe'],
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
        $query = User::find();

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
            'u_id' => $this->u_id,
            'u_type' => $this->u_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'u_status' => $this->u_status,
        ]);

        $query->andFilterWhere(['like', 'u_name', $this->u_name])
            ->andFilterWhere(['like', 'u_email', $this->u_email])
            ->andFilterWhere(['like', 'u_password', $this->u_password])
            ->andFilterWhere(['like', 'u_store_name', $this->u_store_name])
            ->andFilterWhere(['like', 'u_contact_no', $this->u_contact_no])
            ->andFilterWhere(['like', 'u_photo', $this->u_photo])
            ->andFilterWhere(['like', 'u_address', $this->u_address])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        return $dataProvider;
    }
}
