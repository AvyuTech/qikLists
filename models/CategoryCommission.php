<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_commission".
 *
 * @property integer $cc_id
 * @property string $cc_name
 * @property string $cc_commission
 * @property integer $cc_seller_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $cc_status
 */
class CategoryCommission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_commission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cc_name', 'cc_commission'], 'required'],
            [['cc_commission'], 'number'],
            [['cc_seller_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'cc_status'], 'integer'],
            [['cc_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cc_id' => 'Cc ID',
            'cc_name' => 'Cc Name',
            'cc_commission' => 'Cc Commission',
            'cc_seller_id' => 'Cc Seller ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'cc_status' => 'Cc Status',
        ];
    }
}
