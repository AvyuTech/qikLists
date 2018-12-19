<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "affiliates".
 *
 * @property integer $a_id
 * @property integer $a_user_id
 * @property string $a_affiliate_coupon
 * @property string $a_allocated_stripe_coupon
 * @property string $a_valid_plan
 * @property integer $a_usage_limit
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $a_status
 * @property integer $a_payout_percentage
 */
class Affiliates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'affiliates';
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
            [['a_user_id', 'a_affiliate_coupon', 'a_allocated_stripe_coupon'], 'required'],
            [['a_user_id', 'a_usage_limit', 'created_by', 'updated_by', 'created_at', 'updated_at', 'a_status'], 'integer'],
            [['a_payout_percentage', 'a_affiliate_coupon', 'a_allocated_stripe_coupon', 'a_valid_plan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'a_id' => 'A ID',
            'a_user_id' => 'User',
            'a_affiliate_coupon' => 'Affiliate Coupon',
            'a_allocated_stripe_coupon' => 'Allocated Stripe Coupon',
            'a_payout_percentage' => 'Payout Percentage(%)',
            'a_valid_plan' => 'Valid Plan',
            'a_usage_limit' => 'Usage Limit',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'a_status' => 'A Status',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['u_id' => 'a_user_id']);
    }

    public static function getVisibility($status=null) {
        $data = [
            0 => 'Visible',
            1 => 'Hidden'
        ];

        if(is_null($status)) {
            return $data;
        } else {
            return $data[$status];
        }
    }
}
