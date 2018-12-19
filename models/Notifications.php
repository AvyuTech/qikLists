<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $id
 * @property string $type
 * @property string $amazon_account
 * @property string $url
 * @property string $text
 * @property string $my_date
 * @property string $date
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'amazon_account', 'url', 'text', 'date'], 'required'],
            [['my_date'], 'safe'],
            [['type', 'amazon_account', 'url', 'date'], 'string', 'max' => 200],
            [['text'], 'string', 'max' => 700],
            [['amazon_account', 'text'], 'unique', 'targetAttribute' => ['amazon_account', 'text'], 'message' => 'The combination of Amazon Account and Text has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'amazon_account' => 'Amazon Account',
            'url' => 'Url',
            'text' => 'Text',
            'my_date' => 'My Date',
            'date' => 'Date',
        ];
    }
}
