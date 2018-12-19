<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "applied_repriser_rule".
 *
 * @property integer $arr_id
 * @property integer $arr_rule_id
 * @property string $arr_repriser_price
 * @property string $arr_sku
 * @property string $arr_min_price
 * @property string $arr_max_price
 * @property string $arr_own_buy_box_price
 * @property integer $arr_user_id
 * @property string $arr_user_email
 * @property string $arr_date
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $arr_status
 */
class AppliedRepriserRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'applied_repriser_rule';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
            ],
            'blameable' => [
                'class' =>  'yii\behaviors\BlameableBehavior',
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['arr_rule_id', 'arr_sku', 'arr_min_price', 'arr_max_price', 'arr_user_id'], 'required'],
            [['arr_rule_id', 'arr_user_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'arr_status'], 'integer'],
            [['arr_repriser_price', 'arr_min_price', 'arr_max_price', 'arr_own_buy_box_price'], 'number'],
            [['arr_date'], 'safe'],
            [['arr_sku', 'arr_user_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'arr_id' => 'Arr ID',
            'arr_rule_id' => 'Rule',
            'arr_repriser_price' => 'Repricer Price',
            'arr_sku' => 'Sku',
            'arr_min_price' => 'Min Price',
            'arr_max_price' => 'Max Price',
            'arr_own_buy_box_price' => 'Own Buy Box Price',
            'arr_user_id' => 'User ID',
            'arr_user_email' => 'User Email',
            'arr_date' => 'Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'arr_status' => 'Arr Status',
        ];
    }
}
