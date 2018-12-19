<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asin".
 *
 * @property integer $id
 * @property string $sku
 * @property string $asin
 * @property string $new_value
 * @property string $old_value
 * @property string $amazon_account
 * @property string $picture
 * @property string $date
 */
class Asin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku', 'asin', 'new_value', 'old_value', 'amazon_account', 'picture'], 'required'],
            [['date'], 'safe'],
            [['sku', 'asin', 'amazon_account', 'picture'], 'string', 'max' => 200],
            [['new_value', 'old_value'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Sku',
            'asin' => 'Asin',
            'new_value' => 'New Value',
            'old_value' => 'Old Value',
            'amazon_account' => 'Amazon Account',
            'picture' => 'Picture',
            'date' => 'Date',
        ];
    }

    /**
     * get Fine Difference between two string
     * @return string
     */
    public function getStringFineDiff()
    {
        $granularity = new \cogpowered\FineDiff\Granularity\Word;
        $diff        = new \cogpowered\FineDiff\Diff($granularity);
        return $diff->render($this->old_value, $this->new_value);
    }
}
