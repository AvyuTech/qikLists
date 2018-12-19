<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_seller_feedback_report_data".
 *
 * @property integer $fsfrd_id
 * @property string $Date
 * @property string $Rating
 * @property string $Comments
 * @property string $Your_Response
 * @property string $Arrived_on_Time
 * @property string $Item_as_Described
 * @property string $Customer_Service
 * @property string $Order_ID
 * @property string $Rater_Email
 * @property string $fsfrd_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaSellerFeedbackReportData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_seller_feedback_report_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fsfrd_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['Date', 'Rating', 'Comments', 'Your_Response', 'Arrived_on_Time', 'Item_as_Described', 'Customer_Service', 'Order_ID', 'Rater_Email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fsfrd_id' => 'Fsfrd ID',
            'Date' => 'Date',
            'Rating' => 'Rating',
            'Comments' => 'Comments',
            'Your_Response' => 'Your  Response',
            'Arrived_on_Time' => 'Arrived On  Time',
            'Item_as_Described' => 'Item As  Described',
            'Customer_Service' => 'Customer  Service',
            'Order_ID' => 'Order  ID',
            'Rater_Email' => 'Rater  Email',
            'fsfrd_date' => 'Fsfrd Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
