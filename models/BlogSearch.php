<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Blog;

/**
 * BlogSearch represents the model behind the search form of `app\models\Blog`.
 */
class BlogSearch extends Blog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'b_status'], 'integer'],
            [['b_title', 'b_description', 'b_feature_image', 'b_category', 'b_tags'], 'safe'],
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
        $query = Blog::find();

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
            'b_id' => $this->b_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'b_status' => $this->b_status,
        ]);

        $query->andFilterWhere(['like', 'b_title', $this->b_title])
            ->andFilterWhere(['like', 'b_description', $this->b_description])
            ->andFilterWhere(['like', 'b_feature_image', $this->b_feature_image])
            ->andFilterWhere(['like', 'b_category', $this->b_category])
            ->andFilterWhere(['like', 'b_tags', $this->b_tags]);

        return $dataProvider;
    }
}
