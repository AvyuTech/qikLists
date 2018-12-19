<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "site_setting".
 *
 * @property integer $ss_id
 * @property string $ss_default_coupon_code
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $ss_status
 * @property string $ss_payout_percentage
 * @property string $ss_payout_months
 */
class SiteSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_setting';
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
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'ss_status', 'ss_payout_months'], 'integer'],
            [['ss_default_coupon_code', 'ss_payout_percentage'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ss_id' => 'Ss ID',
            'ss_default_coupon_code' => 'Default Coupon Code',
            'ss_payout_percentage' => 'Payout Percentage',
            'ss_payout_months' => 'Payout Months',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'ss_status' => 'Ss Status',
        ];
    }
}
