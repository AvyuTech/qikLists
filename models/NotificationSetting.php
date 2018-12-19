<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification_setting".
 *
 * @property integer $ns_id
 * @property string $ns_email
 * @property string $ns_mobile_no
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $ns_status
 */
class NotificationSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_setting';
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
            [['ns_email', 'ns_mobile_no'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'ns_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ns_id' => 'Ns ID',
            'ns_email' => 'Email',
            'ns_mobile_no' => 'Mobile No',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'ns_status' => 'Ns Status',
        ];
    }
}
