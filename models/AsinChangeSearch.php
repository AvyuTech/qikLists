<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AsinChange;

/**
 * AsinChangeSearch represents the model behind the search form about `app\models\AsinChange`.
 */
class AsinChangeSearch extends AsinChange
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['changeCount', 'ac_status', 'start_date', 'end_date', 'sku', 'asin', 'new_value', 'old_value', 'amazon_account', 'picture', 'date'], 'safe'],
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
        $query = AsinChange::find()->andWhere(['diff_status' => 1]);

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
            'id' => $this->id,
            'date' => $this->date,
            'ac_status' => $this->ac_status,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'asin', $this->asin])
            ->andFilterWhere(['like', 'old_value', $this->old_value])
            ->andFilterWhere(['like', 'amazon_account', $this->amazon_account])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['between', 'date', $this->start_date, $this->end_date]);

        if($this->changeCount) {
            $query->andFilterWhere(['like', 'new_value', $this->changeCount]);
        } else {
            $query->andFilterWhere(['like', 'new_value', $this->new_value]);
        }
        return $dataProvider;
    }
}
