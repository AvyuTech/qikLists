<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_last_fetch_datetime".
 *
 * @property integer $dlfd_id
 * @property string $dlfd_last_orders_time
 */
class DataLastFetchDatetime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_last_fetch_datetime';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dlfd_last_orders_time'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dlfd_id' => 'Dlfd ID',
            'dlfd_last_orders_time' => 'Dlfd Last Orders Time',
        ];
    }
}
