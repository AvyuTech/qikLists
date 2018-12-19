<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AllProductDetails;

/**
 * AllProductDetailsSearch represents the model behind the search form about `app\models\AllProductDetails`.
 */
class AllProductDetailsSearch extends AllProductDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apd_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'apd_status'], 'integer'],
            [['apd_asin', 'apd_binding', 'apd_brand', 'apd_color', 'apd_department', 'apd_label', 'apd_size'], 'safe'],
            [['apd_item_height', 'apd_item_width', 'apd_item_length', 'apd_item_weight', 'apd_package_height', 'apd_package_width', 'apd_package_length', 'apd_package_weight'], 'number'],
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
        $query = AllProductDetails::find();

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
            'apd_id' => $this->apd_id,
            'apd_item_height' => $this->apd_item_height,
            'apd_item_width' => $this->apd_item_width,
            'apd_item_length' => $this->apd_item_length,
            'apd_item_weight' => $this->apd_item_weight,
            'apd_package_height' => $this->apd_package_height,
            'apd_package_width' => $this->apd_package_width,
            'apd_package_length' => $this->apd_package_length,
            'apd_package_weight' => $this->apd_package_weight,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'apd_status' => $this->apd_status,
        ]);

        $query->andFilterWhere(['like', 'apd_asin', $this->apd_asin])
            ->andFilterWhere(['like', 'apd_binding', $this->apd_binding])
            ->andFilterWhere(['like', 'apd_brand', $this->apd_brand])
            ->andFilterWhere(['like', 'apd_color', $this->apd_color])
            ->andFilterWhere(['like', 'apd_department', $this->apd_department])
            ->andFilterWhere(['like', 'apd_label', $this->apd_label])
            ->andFilterWhere(['like', 'apd_size', $this->apd_size]);

        return $dataProvider;
    }
}
