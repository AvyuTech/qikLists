<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "user_activity_log".
 *
 * @property integer $ual_id
 * @property integer $ual_user_id
 * @property string $ual_user_ip
 * @property string $ual_request_url
 * @property string $ual_message
 * @property integer $ual_time_spent
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserActivityLog extends \yii\db\ActiveRecord
{
    public $start_date, $end_date;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_activity_log';
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
            [['ual_is_logged', 'ual_user_id', 'ual_time_spent', 'ual_login_at', 'ual_logout_at', 'created_at', 'updated_at'], 'integer'],
            [['ual_request_url', 'start_date', 'end_date'], 'string'],
            [['ual_user_ip'], 'string', 'max' => 100],
            [['ual_message'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ual_id' => 'Ual ID',
            'ual_user_id' => 'User',
            'ual_user_ip' => 'IP',
            'ual_request_url' => 'Requested Url',
            'ual_message' => 'Message',
            'ual_login_at' => 'Login Time',
            'ual_logout_at' => 'Logout Time',
            'start_date' => 'Start Date (Login Time)',
            'end_date' => 'End Date (Login Time)',
            'ual_time_spent' => 'Time Spent (Seconds)',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUserName()
    {
        return $this->hasOne(User::className(), ['u_id' => 'ual_user_id']);
    }
}
