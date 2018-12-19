<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "refer_users".
 *
 * @property integer $ru_id
 * @property integer $ru_refer_user_id
 * @property integer $ru_used_promo_code
 * @property integer $ru_plan
 * @property integer $ru_refer_date
 * @property integer $ru_refered_by
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $ru_status
 * @property string $ru_payment_amount
 * @property string $ru_payment_status
 * @property string $ru_payout_percentage
 * @property string $ru_payment_approve_date
 * @property string $ru_payment_approve_comment
 * @property integer $ru_payout_months
 * @property integer $ru_payout_months_done
 * @property string $ru_yearly_plan
 * @property string $ru_yearly_month_done
 */
class ReferUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refer_users';
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
            /*'blameable' => [
                'class' =>  'yii\behaviors\BlameableBehavior',
            ],*/

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ru_refer_user_id', 'ru_refer_date', 'ru_refered_by'], 'required'],
            [['ru_payout_months_done', 'ru_payout_months', 'ru_refer_user_id', 'ru_used_promo_code', 'ru_plan', 'ru_refered_by', 'created_by', 'updated_by', 'created_at', 'updated_at', 'ru_status'], 'integer'],
            [['ru_yearly_month_done', 'ru_yearly_plan', 'ru_payment_approve_comment', 'ru_used_promo_code', 'ru_plan', 'ru_refer_date', 'ru_payment_amount', 'ru_payment_status', 'ru_payout_percentage', 'ru_payment_approve_date'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ru_id' => 'Ru ID',
            'ru_refer_user_id' => 'Referred User',
            'ru_used_promo_code' => 'Used Promo Code',
            'ru_plan' => 'Selected Plan',
            'ru_refer_date' => 'Refer Date',
            'ru_refered_by' => 'Referred By',
            'ru_payment_amount' => 'Referral Amount',
            'ru_payment_status' => 'Payment Status',
            'ru_payout_percentage' => 'Payout Percentage',
            'ru_payment_approve_date' => 'Payment Approve Date',
            'ru_payment_approve_comment' => 'Comment',
            'ru_payout_months' => 'Payout Months',
            'ru_payout_months_done' => 'Payout Months Done',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ru_status' => 'Ru Status',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['u_id' => 'ru_refer_user_id']);
    }

    public static function getMonthsName($month=null)
    {
        $months = array(
            1 => 'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July ',
            'August',
            'September',
            'October',
            'November',
            'December',
        );

        if($month) {
            if(key_exists($month, $months)) {
                return $months[$month];
            } else {
                return false;
            }
        } else {
            return $months;
        }
    }

    public static function getPaymentStatus($status = null, $html=false)
    {
        $data = [
            1 => 'Approved',
            2 => 'Pending',
            3 => 'Reject'
        ];

        if($status) {
            if(key_exists($status, $data)) {
                return $data[$status];
            } else {
                return false;
            }
        } else {
            return $data;
        }
    }
}
