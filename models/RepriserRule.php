<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "repriser_rule".
 *
 * @property integer $rr_id
 * @property string $rr_name
 * @property string $rr_goal
 * @property string $rr_match_action
 * @property string $rr_pricing_action
 * @property string $rr_pricing_amount
 * @property string $rr_pricing_percentage
 * @property string $rr_rule_comparison
 * @property integer $rr_rule_comparison_ignore_amazon
 * @property string $rr_raise_price
 * @property string $rr_raise_price_action
 * @property string $rr_raise_price_amount
 * @property string $rr_raise_price_type
 * @property string $rr_raise_price_comparison
 * @property integer $rr_raise_price_comparison_ignore_amazon
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $rr_status
 * @property integer $rr_pricing_amount_type
 */
class RepriserRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repriser_rule';
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
            [['rr_pricing_amount', 'rr_pricing_amount_type', 'rr_raise_price_amount', 'rr_raise_price_type',], 'number'], //'rr_pricing_percentage', 'rr_raise_price_percentage'
            [['rr_rule_comparison_ignore_amazon', 'rr_raise_price_comparison_ignore_amazon', 'created_at', 'updated_at', 'created_by', 'updated_by', 'rr_status'], 'integer'],
            [['rr_name', 'rr_goal', 'rr_match_action', 'rr_pricing_action', 'rr_rule_comparison', 'rr_raise_price', 'rr_raise_price_action', 'rr_raise_price_comparison'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rr_id' => 'Rr ID',
            'rr_name' => 'Name',
            'rr_goal' => 'Goal',
            'rr_match_action' => 'Match Action',
            'rr_pricing_action' => 'Pricing Action',
            'rr_pricing_amount' => 'Pricing Amount',
            'rr_pricing_amount_type' => 'Pricing Amount Type',
            'rr_rule_comparison' => 'Rule Comparison',
            'rr_rule_comparison_ignore_amazon' => 'Rule Comparison Ignore Amazon',
            'rr_raise_price' => 'Raise Price',
            'rr_raise_price_action' => 'Raise Price Action',
            'rr_raise_price_amount' => 'Raise Price Amount',
            'rr_raise_price_type' => 'Raise Pricing Amount Type',
            'rr_raise_price_comparison' => 'Raise Price Comparison',
            'rr_raise_price_comparison_ignore_amazon' => 'Raise Price Comparison Ignore Amazon',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'rr_status' => 'Rr Status',
        ];
    }

    public static function getGoal($type=null)
    {
        $data = ['1' => 'Buy Box Price', '2' => 'Lowest Price'];

        if($type && key_exists($type, $data)) {
            return $data[$type];
        }

        if($type && !key_exists($type, $data)) {
            return null;
        }

        return $data;
    }

    public static function getMatchAction($type=null)
    {
        $data = ['1' => 'Stay below th e Buy Box price by a specified amount', '2' => 'Match price exactly', '3' => 'Stay above price by a specified amount'];

        if($type && key_exists($type, $data)) {
            return $data[$type];
        }

        return $data;
    }

    public static function getRuleComparison($type=null)
    {
        $data = ['1' => 'All offers for the same ASIN and condition', '2' => 'Only offers with the same fulfillment method']; //'3' => 'If no offers for the same ASIN and condition available, then all offers with the same fulfillment method'

        if($type && key_exists($type, $data)) {
            return $data[$type];
        }

        return $data;
    }
}
