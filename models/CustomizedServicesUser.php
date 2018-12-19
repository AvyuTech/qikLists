<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customized_services_user".
 *
 * @property integer $csu_id
 * @property string $csu_first_name
 * @property string $csu_last_name
 * @property string $csu_email
 * @property string $csu_contact_no
 * @property string $csu_otp
 * @property integer $csu_is_payment_done
 * @property string $csu_payment_stripe_id
 * @property string $csu_services
 * @property string $csu_date
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $csu_status
 * @property string $csu_cust_id
 * @property integer $csu_amount
 * @property string $csu_stripe_invoice_id
 * @property string $csu_extra_comment
 * @property string $csu_audio_file
 */
class CustomizedServicesUser extends \yii\db\ActiveRecord
{
    public $re_enter_email;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customized_services_user';
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
            [['csu_first_name', 'csu_last_name', 'csu_email', 'csu_contact_no', 'csu_services'], 'required'],
            [['csu_is_payment_done', 'created_at', 'updated_at', 'created_by', 'updated_by', 'csu_status'], 'integer'],
            [['csu_date', 'csu_amount', 'csu_stripe_invoice_id'], 'safe'],
            [['csu_first_name', 'csu_last_name', 'csu_contact_no'], 'string', 'max' => 100],
            [['csu_email', 'csu_cust_id', 're_enter_email'], 'string', 'max' => 150],
            [['csu_otp'], 'string', 'max' => 20],
            [['csu_payment_stripe_id'], 'string', 'max' => 255],
            [['csu_extra_comment', 'csu_audio_file'], 'string'],
            [['csu_email', 're_enter_email'], 'required', 'on' => 'request-service'],
            ['re_enter_email', 'compare', 'compareAttribute' => 'csu_email', 'message' => "Re-enter Email does not match with Email"],
            //[['csu_email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'csu_id' => 'Csu ID',
            'csu_first_name' => 'First Name',
            'csu_last_name' => 'Last Name',
            'csu_services' => 'Service',
            'csu_amount' => 'Invoice Amount',
            'csu_email' => 'Email',
            're_enter_email' => 'Re-enter Email',
            'csu_contact_no' => 'Contact No',
            'csu_otp' => 'Otp',
            'csu_extra_comment' => 'Feel free to share some details with us',
            'csu_audio_file' => 'Record Voice',
            'csu_stripe_invoice_id' => 'Invoice ID',
            'csu_is_payment_done' => 'Payment Status',
            'csu_payment_stripe_id' => 'Payment Charge ID',
            'csu_date' => 'Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'csu_status' => 'Csu Status',
        ];
    }

    public static function getServices()
    {
        $data = [
            'FULL Account Health Assessment' => 'FULL Account Health Assessment',
            'Seller-At-Fault Negative Feedback Resolution' => 'Seller-At-Fault Negative Feedback Resolution',
            'ASIN Suspension Reinstatement' => 'ASIN Suspension Reinstatement',
            'Account Suspension Reinstatement' => 'Account Suspension Reinstatement',
            'IP & Trademark Rights Holder Infringement Claims Resolution' => 'IP & Trademark Rights Holder Infringement Claims Resolution',
            'Safety & Inauthentic Complaints' => 'Safety & Inauthentic Complaints',
            'Category Ungating' => 'Category Ungating',
            'Brand Registry' => 'Brand Registry',
            'MAP Management' => 'MAP Management',
            'Other Service Requests' => 'Other Service Requests',
        ];

        return $data;
    }
}
