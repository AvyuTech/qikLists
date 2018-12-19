<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fetched_report_data".
 *
 * @property integer $frd_id
 * @property string $frd_report_id
 * @property string $frd_report_datetime
 * @property string $frd_report_type
 * @property string $frd_date
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $frd_status
 */
class FetchedReportData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fetched_report_data';
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
            [['frd_date'], 'safe'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'frd_status'], 'integer'],
            [['frd_report_id', 'frd_report_datetime'], 'string', 'max' => 100],
            [['frd_report_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'frd_id' => 'Frd ID',
            'frd_report_id' => 'Frd Report ID',
            'frd_report_datetime' => 'Frd Report Datetime',
            'frd_report_type' => 'Frd Report Type',
            'frd_date' => 'Frd Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'frd_status' => 'Frd Status',
        ];
    }
}
